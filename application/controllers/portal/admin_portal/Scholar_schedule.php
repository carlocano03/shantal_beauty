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

class Scholar_schedule extends MY_Controller
{
    private $counter_member = SCHOLAR_MEMBER;
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
        $this->load->model('portal/admin_portal/scholar_schedule_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('adminIn', 'login');
    } //End __construct

    public function get_student_with_schedule()
    {
        $student = $this->scholar_schedule_model->get_student_with_schedule();
        $data = array();
        $no = $_POST['start'];
        foreach ($student as $list) {
            $no++;
            $row = array();

            $member_id = $this->cipher->encrypt($list->member_id);
            $img = base_url()."assets/images/avatar-default-0.png";
            if(!empty($list->personal_photo)){
                if(file_exists('./assets/uploaded_attachment/personal_photo/'.$list->personal_photo)){
                    $img = base_url()."assets/uploaded_attachment/personal_photo/".$list->personal_photo;
                }
            }

            $row[] = '<img class="img-profile" src="' . $img . '" alt="Profile-Picture">';
            $row[] = $list->scholarship_no;
            $row[] = ucfirst($list->student_last_name).', '.ucfirst($list->student_first_name).' '.ucfirst($list->student_middle_name);

            $color_mapping = [
                'Sunday' => 'bg-success',
                'Thursday' => 'bg-primary',
            ];
            $badge_color = isset($color_mapping[$list->day_week]) ? $color_mapping[$list->day_week] : 'bg-warning';

            $time_sched = date('h:i A', strtotime($list->time_in)) .' - '. date('h:i A', strtotime($list->time_out));
            $row[] = '<div class="badge ' . $badge_color . ' px-3">' . $list->day_week . '</div>' . 
                     '<div><i class="bi bi-clock me-1"></i>'.$time_sched.'</div>';
            
            $row[] = '<div class="btn-group">
                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item link-cursor text-primary manage_attendance" data-id="'.$member_id.'"><i class="bi bi-view-list me-2"></i>Manage Attendance</a></li>
                        </ul>
                    </div>';

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->scholar_schedule_model->count_all(),
            "recordsFiltered" => $this->scholar_schedule_model->count_filtered(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

    public function get_student_without_schedule()
    {
        $student = $this->scholar_schedule_model->get_student_without_schedule();
        $data = array();
        $no = $_POST['start'];
        foreach ($student as $list) {
            $no++;
            $row = array();

            $img = base_url()."assets/images/avatar-default-0.png";
            if(!empty($list->personal_photo)){
                if(file_exists('./assets/uploaded_attachment/personal_photo/'.$list->personal_photo)){
                    $img = base_url()."assets/uploaded_attachment/personal_photo/".$list->personal_photo;
                }
            }

            $row[] = '<img class="img-profile" src="' . $img . '" alt="Profile-Picture">';
            $row[] = $list->scholarship_no;
            $row[] = ucfirst($list->student_last_name).', '.ucfirst($list->student_first_name).' '.ucfirst($list->student_middle_name);
            $row[] = '<div class="badge bg-danger px-3">No Schedule</div>';

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->scholar_schedule_model->count_all_without(),
            "recordsFiltered" => $this->scholar_schedule_model->count_filtered_without(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

    public function getCountSchedule()
    {
        $with_schedule = $this->scholar_schedule_model->get_count_with_schedule();
        $without_schedule = $this->scholar_schedule_model->get_count_without_schedule();

        $output = array(
            'with_schedule' => $with_schedule,
            'without_schedule' => $without_schedule,
        );
        echo json_encode($output);
    }

    public function getBiometricLogs($page = 0)
    {
        $output = '';
        $error = '';
        $config = array();
        $config["base_url"] = base_url() . "portal/admin_portal/scholar_schedule/getBiometricLogs/";
        $config["total_rows"] = $this->scholar_schedule_model->biometric_logs_count();
        $config["per_page"] = 5;
        $config["uri_segment"] = 5; // Adjusted uri_segment to match your setup

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

        $biometric = $this->scholar_schedule_model->biometric_logs($config["per_page"], $page);
        if ($biometric->num_rows() > 0) {
            foreach($biometric->result() as $list) {
                $img = base_url()."assets/images/avatar-default-0.png";
                if(!empty($list->personal_photo)){
                    if(file_exists('./assets/uploaded_attachment/personal_photo/'.$list->personal_photo)){
                        $img = base_url()."assets/uploaded_attachment/personal_photo/".$list->personal_photo;
                    }
                }

                if ($list->remarks == 'Time-In') {
                    $remarks = 'TIME-IN | <i class="bi bi-hourglass-split me-1"></i>'.date('h:i A', strtotime($list->time_transaction));
                    $textColor = 'text-success';
                } else {
                    $remarks = 'TIME-OUT | <i class="bi bi-hourglass-split me-1"></i>'.date('h:i A', strtotime($list->time_transaction));
                    $textColor = 'text-danger';
                }

                $output .= '
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img class="img-bio me-2" src="'.$img.'">
                            <div>'.ucwords($list->scholar).'</div>
                        </div>
                        <div class="'.$textColor.'">
                            <div style="font-size:12px; font-weight:600;">'.$remarks.'</div>
                            <div class="text-end text-uppercase" style="font-size:10px;">'.date('M j, Y', strtotime($list->attendance_date)).'</div>
                        </div>
                    </div> 
                    <hr class="mt-2 mb-2">
                ';
            }
        } else {
            $error .= '
                <div class="alert alert-danger"><i class="bi bi-info-circle me-2"></i>No record found.</div>
            ';
        }
        $data['biometric_logs'] = $output;
        $data['error'] = $error;
        echo json_encode($data);
    }
}