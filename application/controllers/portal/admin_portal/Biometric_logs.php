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

class Biometric_logs extends MY_Controller
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
        $this->load->model('portal/admin_portal/biometric_logs_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('adminIn', 'login');
    } //End __construct

    public function index()
    {
        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/portal');
        $data['active_page'] = 'biometric_page';
        $data['card_title'] = 'Biometric Logs';
        $data['icon'] = 'bi bi-fingerprint';
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
        $this->load->view('admin_portal/biometric_logs', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function get_biometric_logs()
    {
        $logs = $this->biometric_logs_model->get_biometric_logs();
        $data = array();
        $no = $_POST['start'];
        foreach ($logs as $list) {
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
            $row[] = ucwords($list->scholar);
            $row[] = date('F j, Y', strtotime($list->attendance_date));
            $row[] = date('h:i A', strtotime($list->time_transaction));
	
			

            $color_mapping = [
                'Time-In' => 'bg-success',
                'Time-Out' => 'bg-danger',
            ];
            $badge_color = isset($color_mapping[$list->remarks]) ? $color_mapping[$list->remarks] : 'bg-warning';
            $row[] = '<div class="badge ' . $badge_color . ' px-3">' . $list->remarks . '</div>';

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->biometric_logs_model->count_all(),
            "recordsFiltered" => $this->biometric_logs_model->count_filtered(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

	// public function get_single_biometric_log(){
	// 	$id = $this->input->post('id');

	// 	$log = $this->biometric_logs_model->get_biometric_log_by_id($id);

	// 	if($log){
	// 		$img = base_url()."assets/images/avatar-default-0.png";
	// 		if(!empty($log->personal_photo)){
	// 			if(file_exists('./assets/uploaded_attachment/personal_photo/'.$log->personal_photo)){
    //                 $img = base_url()."assets/uploaded_attachment/personal_photo/".$log->personal_photo;
    //             }
	// 		}

	// 		$color_mapping = [
    //             'Time-In' => 'bg-success',
    //             'Time-Out' => 'bg-danger',
    //         ];
			
	// 		$badge_color = isset($color_mapping[$log->remarks]) ? $color_mapping[$log->remarks] : 'bg-warning';

	// 		$data = array(
	// 			'b_student_img' => $img,
    //             'b_scholar_no' => $log->scholarship_no,
    //             'b_student_name' => $log->scholar,
    //             'b_date' => date('F j, Y', strtotime($log->attendance_date)),
    //             'b_time' => date('h:i A', strtotime($log->time_transaction)),
    //             'b_type' => $badge_color
	// 		);

	// 		echo json_encode($data);

	// 	}else{
	// 		echo json_encode(['status' => 'error', 'message' => 'Log not found']);
	// 	}
	// }
}