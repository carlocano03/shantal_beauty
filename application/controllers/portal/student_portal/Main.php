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
        $this->lang->load('common','english');
        $this->load->model('portal/student_portal/main_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('scholarIn', 'login');
    } //End __construct

    public function index()
    {
        $data['student_info'] = $this->main_model->get_row('scholarship_member', array('user_id' => $this->session->userdata('scholarIn')['user_id']));
        $data['home_url'] = base_url('student/portal');
        $data['active_page'] = 'dashboard_page';
        $data['card_title'] = 'Dashboard';
        $data['icon'] = 'bi bi-speedometer2';
        $this->load->view('student_portal/partial/_header', $data);
        $this->load->view('student_portal/dashboard', $data);
        $this->load->view('student_portal/partial/_footer', $data);
    }

    // Error 404 redirect
	public function page404()
	{
		$this->load->view('error404');
	}

    public function getAvailableSched()
    {
        $output = '';
        $error = '';
        $sched = $this->main_model->getAvailableSched();
        $selected_sched = $this->main_model->check_schedule($this->session->userdata('scholarIn')['member_id']);

        if ($selected_sched->num_rows() == 0) {
            $error = '<div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>No Schedule Selected.</div>';
        }
        $no = 0;
        if ($sched->num_rows() > 0) {
            foreach($sched->result() as $list) {
                //selected-date
                //<div class="upcoming-sched__selected">Selected</div>

                $check_selected_sched = $this->main_model->check_selected_sched($list->sched_id);
                if ($check_selected_sched->num_rows() > 0) {
                    $selected_date = 'selected-date';
                    $remarks = '<div class="upcoming-sched__selected">Selected</div>';
                } else {
                    $selected_date = '';
                    $remarks = '';
                }

                $no++;
                $output .= '
                    <div class="upcoming-sched__date-container-'.$no.' mb-3 '.$selected_date.'" style="cursor:pointer;" id="save_schedule" data-id="'.$list->sched_id.'">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h1 class="upcoming-sched__weekday mb-0">'.$list->day_week.'</h1>
                            '.$remarks.'
                        </div>
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
            'available_sched' => $output,
            'error' => $error,
        );
        echo json_encode($data);
    }

    public function save_schedule()
    {
        $error = '';
        $success = '';

        $member_id = $this->session->userdata('scholarIn')['member_id'];
        $sched_id = $this->input->post('sched_id', true);
        $schedule = $this->main_model->get_row('church_schedule', array('sched_id' => $sched_id));
        $start_dt = date('Y-m-01');
        $end_date_obj = date('Y-m-t');

        $check_sched = $this->main_model->check_existing_schedule($start_dt, $end_date_obj);
        if ($check_sched->num_rows() > 0) {
            $error = 'You already have a schedule for this month.';
        } else {
            $insert_sched = array(
                'member_id'     => $member_id,
                'date_from'     => $start_dt,
                'date_to'       => $end_date_obj,
                'schedule_name' => $schedule['schedule_name'],
                'sched_id'      => $sched_id,
                'date_created'  => date('Y-m-d H:i:s'),
            );

            $scholar_sched_id = $this->main_model->insert_scholar_schedule($insert_sched);
            if ($scholar_sched_id != '') {

                //Generate schedule list
                $this->main_model->insert_scholar_selected_schedule($scholar_sched_id, $member_id, $start_dt, $end_date_obj, $schedule['time_in'], $schedule['time_out'], $schedule['day_week'], $sched_id);

                $success = 'Church schedule has been successfully selected.';
            } else {
                $error = 'Failed to select a schedule.';
            }
        }
        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }

}
//End CI_Controller
