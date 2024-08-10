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

class Main extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('language');
        $this->load->library('cipher');
        $this->lang->load('common','english');
        $this->load->model('portal/admin_portal/main_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('adminIn', 'login');
    } //End __construct

    public function index()
    {
        $data['scholar_application'] = $this->main_model->get_total_approval('For Approval');
        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/portal');
        $data['active_page'] = 'dashboard_page';
        $data['card_title'] = 'Dashboard';
        $data['icon'] = 'bi bi-speedometer2';
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
        $this->load->view('admin_portal/dashboard', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    // Error 404 redirect
	public function page404()
	{
		$this->load->view('error404');
	}

    public function getCount()
    {
        $total_scholar = $this->main_model->get_total_scholar();
        $total_application = $this->main_model->get_total_application();
        $total_approval = $this->main_model->get_total_approval('For Approval');
        $total_denied = $this->main_model->get_total_approval('Declined');

        $output = array(
            'total_scholars' => $total_scholar->num_rows(),
            'total_application' => $total_application->num_rows(),
            'total_approval' => $total_approval->num_rows(),
            'total_denied' => $total_denied->num_rows(),
        );
        echo json_encode($output);
    }

    public function getScholarshipRequest()
    {
        $output = '';
        $request = $this->main_model->getScholarshipRequest();
        $role_permissions = $this->role_permissions();
        $action1 = '';
        $action2 = '';
        foreach($request->result() as $list) {
            $fullname = $list->student_last_name.', '.$list->student_first_name.' '.$list->student_middle_name;
            $dayRequest = date('D', strtotime($list->date_application));
            $application_id = $this->cipher->encrypt($list->application_id);

            if ($this->session->userdata('adminIn')['user_type_id'] == ADMINISTRATOR) {
                $action1 = '
                    <a href="'.base_url('admin/scholarship-approval/scholar-information?application=').$application_id.'">
                        <div class="scholarship-req__view">
                            <i class="scholarship-req__icon fa-solid fa-arrow-up-right-from-square text-white"></i>
                        </div>
                    </a>
                ';

                $action2 = '
                    <a href="'.base_url('admin/scholarship-approval/scholar-information?application=').$application_id.'">
                        <div class="scholarship-req__approve">
                            <i class="fa-solid fa-check"></i>
                        </div>
                    </a>
                    <a href="'.base_url('admin/scholarship-approval/scholar-information?application=').$application_id.'">
                        <div class="scholarship-req__denied">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                    </a>
                ';
            } else {
                if (in_array(SCHOLAR_APPLICATION, $role_permissions)) {
                    $action1 = '
                        <a href="'.base_url('admin/scholarship-approval/scholar-information?application=').$application_id.'">
                            <div class="scholarship-req__view">
                                <i class="scholarship-req__icon fa-solid fa-arrow-up-right-from-square text-white"></i>
                            </div>
                        </a>
                    ';

                    $action2 = '
                        <a href="'.base_url('admin/scholarship-approval/scholar-information?application=').$application_id.'">
                            <div class="scholarship-req__approve">
                                <i class="fa-solid fa-check"></i>
                            </div>
                        </a>
                        <a href="'.base_url('admin/scholarship-approval/scholar-information?application=').$application_id.'">
                            <div class="scholarship-req__denied">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                        </a>
                    ';
                }
            }

            $img = base_url()."assets/images/avatar-default-0.png";
            if(!empty($list->personal_photo)){
                if(file_exists('./assets/uploaded_attachment/personal_photo/'.$list->personal_photo)){
                    $img = base_url()."assets/uploaded_attachment/personal_photo/".$list->personal_photo;
                }
            }

            $output .= '
                <div class="col">
                    <div class="overview-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <img class="scholarship-req__avatar"
                                    src="'.$img.'"
                                    alt="applicant">
                                <div class="scholarship-req__name">'.ucwords($fullname).'</div>
                            </div>
                            '.$action1.'
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <h1 class="scholarship-req__date mb-2">'.$dayRequest.', '.date('F j, Y', strtotime($list->date_application)).'</h1>
                                <div class="scholarship-req__time">'.date('h:i A', strtotime($list->date_application)).'</div>
                            </div>
                            <div class="d-flex align-items-center gap-2 pb-1 align-self-end">
                                '.$action2.'
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }

        $data = array(
            'request_list' => $output,
            'request_count' => $request->num_rows(),
        );
        echo json_encode($data);
    }

    public function getAvailableSched()
    {
        $output = '';
        $sched = $this->main_model->getAvailableSched();
        $no = 0;

		$total_schedules = $sched->num_rows();



        if ($sched->num_rows() > 0) {
            foreach($sched->result() as $list) {
				if($no > 1) break;
                $no++;
                $output .= '
                    <div class="upcoming-sched__date-container-'.$no.' mb-3">
                        <h1 class="upcoming-sched__weekday">'.$list->day_week.'</h1>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="upcoming-sched__date"><i
                                    class="fa-solid fa-calendar custom-text-primary me-2"></i>'.ucwords($list->schedule_name).'</div>
                            <div class="upcoming-sched__time"><i
                                    class="fa-solid fa-clock custom-text-danger me-2"></i>'.date('h:i A', strtotime($list->time_in)).' - '.date('h:i A', strtotime($list->time_out)).'</div>
                        </div>
                    </div>
                ';
            }

			   if ($total_schedules >= 3) {
				$output .= '
					<div class="text-center">
					  <a href="'.base_url('admin/church-schedule').'">
						<button type="button" class="btn" style="text-decoration: underline;">View All</button>
					  </a>
					</div>
				';
			}
        } else {
            $output .= '<div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>No church schedule found.</div>';
        }

	

        $data = array(
            'available_sched' => $output
        );
        echo json_encode($data);
    }

    public function applicationChart()
    {
        $range = $this->input->get('range');
        $data = $this->main_model->applicationChart($range);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function check_old_pass()
    {
        $success = '';
        $error = '';
        $old_pass = $this->input->post('old_pass', true);

        $checkPass = $this->main_model->check_old_pass($old_pass);
        if ($checkPass) {
            $success == 'Success';
        } else {
            $error = 'Please input the correct password';
        }
        $output = array(
            'success' => $success,
            'error' => $error,
        );
        echo json_encode($output);
    }

    public function update_password()
    {
        $message = '';
        $new_password = $this->input->post('password', true);

        $update_password = array(
            'password' => password_hash($new_password, PASSWORD_DEFAULT),
            'temp_password' => '',
        );
        $result = $this->main_model->update_password($update_password);
        if ($result == TRUE) {
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output['message'] = $message;
        echo json_encode($output);
    }

	private function upload_img()
    {
        if (isset($_FILES["product_img"]))
        {
            $dt = Date('His');
            $extension = explode('.', $_FILES['product_img']['name']);
            $new_name = rand() . '_' . $dt . '.' . $extension[1];
            $destination = 'assets/uploaded_attachment/events/' . $new_name;
            move_uploaded_file($_FILES['product_img']['tmp_name'], $destination);
            return $new_name;
        } 
    }

	

	// public function add_event(){
		
	// 		$event_name = $this->input->post('event_name');
	// 		$event_date = $this->input->post('event_date');
	// 		$start_time = $this->input->post('start_time');
	// 		$end_time = $this->input->post("end_time");
	// 		$event_description = $this->input->post("event_description");
		
	// 		$data = array(
	// 			"event_name" => $event_name,
	// 			"event_date" => $event_date,
	// 			"start_time" => $start_time,
	// 			"end_time" => $end_time,
	// 			"event_description" =>$event_description,
	// 			"img" => $this->upload_img(),
	// 		);

	// 		$status = $this->Event_model->insert_event($data);

	// 		echo $status;

	// 		if($status){
	// 			$response = array('status'=>'success','message' => 'Event added successfully.');
	// 		}else{
	// 			$response = array('status'=>'error', 'message' => 'Failed to add event.');
	// 		}

	// 		echo json_encode($response);

	// }

}
//End CI_Controller