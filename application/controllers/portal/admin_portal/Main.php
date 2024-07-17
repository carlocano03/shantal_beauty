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
        
        foreach($request->result() as $list) {
            $fullname = $list->student_last_name.', '.$list->student_first_name.' '.$list->student_middle_name;
            $dayRequest = date('D', strtotime($list->date_application));
            $application_id = $this->cipher->encrypt($list->application_id);
            $output .= '
                <div class="col">
                    <div class="overview-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <img class="scholarship-req__avatar"
                                    src="'.base_url('assets/images/dashboard/student-req.png').'"
                                    alt="applicant">
                                <div class="scholarship-req__name">'.ucwords($fullname).'</div>
                            </div>
                            <a href="'.base_url('admin/scholarship-approval/scholar-information?application=').$application_id.'">
                                <div class="scholarship-req__view">
                                    <i class="scholarship-req__icon fa-solid fa-arrow-up-right-from-square text-white"></i>
                                </div>
                            </a>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <h1 class="scholarship-req__date mb-2">'.$dayRequest.', '.date('F j, Y', strtotime($list->date_application)).'</h1>
                                <div class="scholarship-req__time">'.date('h:i A', strtotime($list->date_application)).'</div>
                            </div>
                            <div class="d-flex align-items-center gap-2 pb-1 align-self-end">
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
        if ($sched->num_rows() > 0) {
            foreach($sched->result() as $list) {
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
}
//End CI_Controller