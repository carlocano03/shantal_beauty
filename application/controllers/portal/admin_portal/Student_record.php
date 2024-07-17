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

class Student_record extends MY_Controller
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
        $this->load->model('portal/admin_portal/student_record_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('adminIn', 'login');
    } //End __construct

    public function index()
    {
        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/portal');
        $data['active_page'] = 'student_record_page';
        $data['card_title'] = 'Student Record Management';
        $data['icon'] = 'bi bi-person-lines-fill';
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
        $this->load->view('admin_portal/student_record', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function student_information()
    {
        $application_id = $this->cipher->decrypt($this->input->get('id'));
        $data['role_permissions'] = $this->role_permissions();
        $data['application'] = $this->student_record_model->get_row('scholarship_member', array('member_id' => $application_id));
        $data['home_url'] = base_url('admin/portal');
        $data['active_page'] = 'student_record_page';
        $data['card_title'] = 'Student Information';
        $data['icon'] = 'bi bi-person-lines-fill';
        $data['header_contents'] = array(
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );
        $this->load->view('admin_portal/partial/_header', $data);
        $this->load->view('admin_portal/student_information', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function get_student_list()
    {
        $student = $this->student_record_model->get_student_list();
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

            $member_id = $this->cipher->encrypt($list->member_id);
            $row[] = '<img class="img-profile" src="' . $img . '" alt="Profile-Picture">';
            $row[] = $list->scholarship_no;
            $row[] = ucfirst($list->student_last_name).', '.ucfirst($list->student_first_name).' '.ucfirst($list->student_middle_name);
            $row[] = ucwords($list->school_name);
            $row[] = date('F j, Y', strtotime($list->birthday));
            $row[] = $list->civil_status;

            $row[] = '
            	<div class="d-block d-lg-none">
				  	 <i data-bs-toggle="modal" data-bs-target="#viewStudentRecordDetails"
                        class="fa-solid fa-circle-plus"></i>
					</div>	
            <div class="btn-group d-none d-lg-block">
                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li><a target="_blank" href="'.base_url('admin/student-record/details?id=').$member_id.'" class="dropdown-item link-cursor text-primary"><i class="bi bi-view-list me-2"></i>View Information</a></li>
                            <li><a class="dropdown-item link-cursor text-danger delete_scholar" data-id="'.$list->member_id.'" data-user="'.$list->user_id.'"><i class="bi bi-trash3-fill me-2"></i>Remove Scholar</a></li>
                        </ul>
                    </div>';

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->student_record_model->count_all(),
            "recordsFiltered" => $this->student_record_model->count_filtered(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

    public function delete_scholar()
    {
        $message = '';
        $member_id = $this->input->post('member_id', true);
        $user_id = $this->input->post('user_id', true);

        $result = $this->student_record_model->delete_scholar($member_id, $user_id);
        if ($result == TRUE) {
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output['message'] = $message;
        echo json_encode($output);
    }

}