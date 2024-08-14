<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */

class Poll_suggestion extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('language');
        $this->load->library('pagination');
        $this->lang->load('common','english');
        $this->load->library('cipher');
        $this->load->model('portal/admin_portal/poll_suggestion_model', 'poll_suggestion');
        $this->load->model('system_counter_generator_model', 'system_counter');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('adminIn', 'login');
    } //End __construct

    public function index()
    {
        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/portal');
        $data['active_page'] = 'poll_suggestion_page';
        $data['card_title'] = 'Poll and Suggestions';
        $data['icon'] = 'bi bi-stack';
        $data['header_contents'] = array(
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );
        $this->load->view('admin_portal/partial/_header', $data);
        $this->load->view('admin_portal/poll_suggestion', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function add_new_poll()
    {
        $success = '';
        $error = '';
        $poll_title = $this->input->post('poll_title', true);

        $check_active_poll = $this->poll_suggestion->check_active_poll();
        if ($check_active_poll->num_rows() > 0) {
            $error = 'You have an active poll. Please end the poll before adding a new one.';
        } else {
            $insert_poll = array(
                'user_id'       => $this->session->userdata('adminIn')['user_id'],
                'poll_question' => $poll_title,
                'date_created'  => date('Y-m-d H:i:s'),
            );
            $poll_id = $this->poll_suggestion->add_new_poll($insert_poll);
            if ($poll_id != '') {
                //Insert poll choicess
                $choices = $this->input->post('choices');
                $pollChoices = json_decode($choices, true);
    
                foreach($pollChoices as $poll_choices) {
                    $insert_data = array(
                        'poll_id'      => $poll_id,
                        'poll_choices'     => $poll_choices['choices'],
                    );
                    $this->poll_suggestion->insert_poll_choices($insert_data);
                }
                $success = 'New poll successfully added.';
            } else {
                $error = 'Failed to add the data.';
            }
        }
        
        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }

    public function getPollRequest()
    {
        $output = '';

        $poll = $this->poll_suggestion->getPollRequest();
        if ($poll->num_rows() > 0) {
            foreach($poll->result() as $list) {

                $choices = explode('|', $list->pollChoices);
                $choicesList = '<div class="btn-group-vertical" style="width:100%;">';
                foreach ($choices as $poll_Choices) {
                    list($poll_choices_id, $poll_choices) = explode(':', $poll_Choices);
                    $choicesList .= '
                        <input type="radio" disabled class="btn-check" name="pollChoices" id="btnradio'.$poll_choices_id.'" value="'.$poll_choices_id.'" required>
                        <label class="btn btn-outline-primary text-start not-rounded" for="btnradio'.$poll_choices_id.'">'.ucfirst($poll_choices).'</label>
                    ';
                }
                $choicesList .= '</div>';

                $output .= '
                    <div class="col-md-6">
                        <div class="card p-3 pb-3">
                            <div class="poll_question">
                                <h5 style="font-size:14px;"><i class="bi bi-question-circle me-1"></i>'.ucfirst($list->poll_question).'</h5>
                                <form id="answerForm" class="needs-validation" novalidate>
                                    <input type="hidden" value="'.$list->poll_id.'" id="pollID"></input>
                                    '.$choicesList.'
                                    <hr class="mb-1">
                                </form>      
                            </div>
                        </div>
                    </div>
                ';
                // <button type="button" class="btn btn-secondary" id="submit_answer" style="width:100%;" disabled>Submit</button>

                $poll_result = '<div class="poll_result">';
                foreach ($choices as $poll_Choices) {
                    list($poll_choices_id, $poll_choices) = explode(':', $poll_Choices);
                    $poll_answer = $this->poll_suggestion->get_poll_answer($poll_choices_id);
                    $total_answer = $poll_answer->num_rows();
                    $totalAnswer = $poll_answer->num_rows();
                    $totalAnswer *= 3;

                    $voteTotal = 'width:'.$totalAnswer.'%';
                    $title = 'Total Vote: '.$total_answer;

                    $poll_result .= '
                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <h5 class="mb-0" style="font-size:13px;">'.$poll_choices.'</h5>
                            </div>
                            <div class="progress" style="height:16px; cursor:pointer" title="'.$title.'">
                                <div class="progress-bar bg-info progress-bar-striped progress-bar-animate" role="progressbar" style="'.$voteTotal.'" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" title="'.$title.'">'.$total_answer.'</div>
                            </div>
                        </div>
                    ';
                }
                $poll_result .= '<div>';

                $action = '<button class="btn btn-dark btn-sm end_poll" data-id="'.$list->poll_id.'">End This Poll</button>';

                $output .= '
                    <div class="col-md-6">
                        <div class="alert alert-success p-2 d-flex align-items-center justify-content-between">
                            <span><i class="bi bi-info-circle-fill me-2"></i>Polling Result</span>
                            '.$action.'
                        </div>
                        '.$poll_result.'
                    </div>
                ';
            }
        } else {
            $output .= '<div class="col-md-12 alert alert-danger"><i class="bi bi-info-circle me-2"></i>No poll request found.</div>';
        }
        $data['poll_request'] = $output;
        // Return JSON data for AJAX
        echo json_encode($data);
    }

    public function end_poll()
    {
        $error = '';
        $success = '';

        $poll_id = $this->input->post('poll_id', true);
        $result = $this->poll_suggestion->end_poll($poll_id);
        if ($result == TRUE) {
            $success = 'The poll ended successfully.';
        } else {
            $error = 'Failed to update record.';
        }
        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }

    public function getSuggestion($page = 0)
    {
        $output = '';
        $config = array();
        $config["base_url"] = base_url() . "portal/admin_portal/poll_suggestion/getSuggestion";
        $config["total_rows"] = $this->poll_suggestion->get_suggestion_count();
        $config["per_page"] = 5;
        $config["uri_segment"] = 4; // Adjusted uri_segment to match your setup

        // Bootstrap 5 Pagination
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        // Fetch data based on pagination
        $data["links"] = $this->pagination->create_links();
        $suggestion = $this->poll_suggestion->getSuggestion($config["per_page"], $page);
        if ($suggestion->num_rows() > 0) {
            foreach ($suggestion->result() as $list) {
                $output .= '
                <div class="card p-3 pb-3 pt-1 mb-3">
                    <div class="text-end">
                        <span style="font-size:10px; font-style: italic; font-weight:500; color:#b2bec3">'.date('D M j, Y h:i A', strtotime($list->date_created)).'</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="me-3">
                            <div class="bg-polygon"
                                style="background: linear-gradient(310.31deg, #54BA49 14.71%, #97D47D 100%);">
                                <img src="'.base_url('assets/images/client/standard_user.png').'" style="width:42px">
                            </div>
                        </div>
                        <p style="font-size:12px; text-align:justify;">
                            '.ucfirst($list->suggestion).'
                        </p>
                    </div>
                </div>
                ';
            }
        } else {
            $output .= '
                <div class="alert alert-danger"><i class="bi bi-info-circle me-2"></i>No record found.</div>
            ';
        }
        $data['suggestion_list'] = $output;
        // Return JSON data for AJAX
        echo json_encode($data);
    }

}