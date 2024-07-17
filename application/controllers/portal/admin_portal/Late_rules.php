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

class Late_rules extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('language');
        $this->lang->load('common','english');
        $this->load->library('cipher');
        $this->load->model('portal/admin_portal/late_rules_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('adminIn', 'login');
    } //End __construct

    public function index()
    {
        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/portal');
        $data['active_page'] = 'late_rules_page';
        $data['card_title'] = 'Late Rules Management';
        $data['icon'] = 'bi bi-person-fill-slash';
        $data['header_contents'] = array(
            '<link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" rel="stylesheet">',
            '<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>',
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );
        $this->load->view('admin_portal/partial/_header', $data);
        $this->load->view('admin_portal/late_rules', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function add_new_rules()
    {
        $error = '';
        $success = '';
        $rule_name = $this->input->post('rule_name', true);
        $no_late = $this->input->post('no_late', true);
        $no_days = $this->input->post('no_days', true);

        $check_rules = $this->late_rules_model->check_existing_rules($rule_name);
        if ($check_rules->num_rows() > 0) {
            $error = 'Late rule already exist.';
        } else {
            $insert_rule = array(
                'rule_name'     => $rule_name,
                'no_late'       => $no_late,
                'no_days'       => $no_days,
                'date_created'  => date('Y-m-d H:i:s'),
            );
            $result = $this->late_rules_model->save_new_rule($insert_rule);
            if ($result == TRUE) {
                $success = 'Late rule successfully added.';
            } else {
                $error = 'Failed to add new rule.';
            }
        }
        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }

    public function get_rule_list()
    {
        $rule = $this->late_rules_model->get_rule_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($rule as $list) {
            $no++;
            $row = array();

            $row[] = ucwords($list->rule_name);

            if ($list->no_late > 1) {
                $late = ' Lates';
            } else {
                $late = ' Late';
            }
            $row[] = $list->no_late.$late;

            if ($list->no_days > 1) {
                $day = ' Days';
            } else {
                $day = ' Day';
            }
            $row[] = $list->no_days.$day;

            if ($list->status == 1) {
                $row[] = '<label class="switch">
							  <input type="checkbox" class="rule_activation" id="' . $list->late_rule_id  . '">
							  <span class="slider round"></span>
					  	  </label><br>Not Active';
            } else {
                $row[] = '<label class="switch">
							  <input type="checkbox" class="rule_activation" id="' . $list->late_rule_id  . '" checked>
							  <span class="slider round"></span>
					  	  </label><br>Active';
            }

            $row[] = date('D M j, Y h:i A', strtotime($list->date_created));
            $row[] = '
					<div class="d-block d-lg-none">
				  	 <i data-bs-toggle="modal" data-bs-target="#viewLateRulesTableDetails"
                        class="fa-solid fa-circle-plus"></i>
					</div>	

			<div class="btn-group d-none d-lg-block">
                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item link-cursor text-primary" id="update_rule" 
                                    data-id="'.$list->late_rule_id.'"
                                    data-rule_name="'.$list->rule_name.'"
                                    data-no_late="'.$list->no_late.'"
                                    data-no_days="'.$list->no_days.'"
                                ><i class="bi bi-pencil-square me-1"></i>Update Rule</a></li>
                                <li><a class="dropdown-item link-cursor text-danger" id="delete_rule" data-id="'.$list->late_rule_id.'"><i class="bi bi-trash3-fill me-1"></i>Delete Rule</a></li>
                            </ul>
                        </div>';

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->late_rules_model->count_all(),
            "recordsFiltered" => $this->late_rules_model->count_filtered(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }
    
    public function update_rules()
    {
        $error = '';
        $success = '';
        $rule_name = $this->input->post('rule_name', true);
        $no_late = $this->input->post('no_late', true);
        $no_days = $this->input->post('no_days', true);
        $late_rule_id = $this->input->post('late_rule_id', true);

        $update_rule = array(
            'rule_name'     => $rule_name,
            'no_late'       => $no_late,
            'no_days'       => $no_days,
        );
        $result = $this->late_rules_model->update_late_rule($update_rule, $late_rule_id);
        if ($result == TRUE) {
            $success = 'Late rule successfully updated.';
        } else {
            $error = 'Failed to update the rule.';
        }
        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }

    public function rule_activation()
    {
        $message = '';
        $late_rule_id = $this->input->post('late_rule_id', true);
        $action = $this->input->post('action', true);

        if ($action == 'Activate') {
            $update_rule = array(
                'status' => 0, //Activated
            );
        } elseif ($action == 'Deactivate') {
            $update_rule = array(
                'status' => 1, //Deactivated
            );
        } else {
            $update_rule = array(
                'status' => 2, //Deleted
            );
        }

        $result = $this->late_rules_model->update_late_rule($update_rule, $late_rule_id);
        if ($result == TRUE) {
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output = array(
            'message' => $message,
        );
        echo json_encode($output);
    }

}