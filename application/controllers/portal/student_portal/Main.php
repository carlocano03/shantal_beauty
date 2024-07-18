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
        $this->load->library('pagination');
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
        $data['late_rules'] = $this->main_model->getActiveRules();
        $data['student_info'] = $this->main_model->get_row('scholarship_member', array('user_id' => $this->session->userdata('scholarIn')['user_id']));
        $data['home_url'] = base_url('student/portal');
        $data['active_page'] = 'dashboard_page';
        $data['card_title'] = 'Dashboard';
        $data['icon'] = 'bi bi-speedometer2';
        $this->load->view('student_portal/partial/_header', $data);
        $this->load->view('student_portal/dashboard', $data);
        $this->load->view('student_portal/partial/_footer', $data);
    }


	public function myProfile(){
        $data['student_info'] = $this->main_model->get_row('scholarship_member', array('user_id' => $this->session->userdata('scholarIn')['user_id']));
		$data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('student/portal');
        $data['active_page'] = 'my_profile_page';
        $data['card_title'] = 'My Profile';
        $data['icon'] = 'bi bi-speedometer2';
        $this->load->view('student_portal/partial/_header', $data);
        $this->load->view('student_portal/my_profile', $data);
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
        $month = $this->input->post('monthToday', true);
        $sched = $this->main_model->getAvailableSched();
        $selected_sched = $this->main_model->check_schedule($month, $this->session->userdata('scholarIn')['member_id']);

        if ($selected_sched->num_rows() == 0) {
            $error = '<div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>No Schedule Selected.</div>';
        }
        $no = 0;
        if ($sched->num_rows() > 0) {
            foreach($sched->result() as $list) {
                //selected-date
                //<div class="upcoming-sched__selected">Selected</div>

                $check_selected_sched = $this->main_model->check_selected_sched($list->sched_id, $month);
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
        $month = $this->input->post('monthToday', true);
        $start_dt = date('Y-m-01', strtotime($month));
        $end_date_obj = date('Y-m-t', strtotime($month));

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

    public function getTotalAttendance()
    {
        $record = '';
        $schedule = $this->main_model->get_student_schedule_list();
        $total_tardiness_hours = 0;
        $total_tardiness_minutes = 0;

        $total_work_hours = 0;
        $total_work_minutes = 0;
        $tardiness_hours = 0;
        $tardiness_minutes = 0;

        $total_present = 0;
        $total_absent = 0;
        $total_late = 0;

        foreach($schedule->result_array() as $list) {
            //Attendance Data
            $attendance = $this->main_model->get_attendance_record($list['schedule_date']);
            $attendance_row = $attendance->row_array();

            $timeIn = $this->main_model->get_attendance($list['schedule_date'], 'Time-In');
            $timeOut = $this->main_model->get_attendance($list['schedule_date'], 'Time-Out');

            $time_in = '';
            $time_out = '';
            $present = '';
            $absent = '';
            $late = '';

            if ($attendance->num_rows() > 0) {
                if (is_array($attendance_row) && !empty($attendance_row)) {
                    $time_in_arrival = isset($timeIn['time_transaction']) ? strtotime($timeIn['time_transaction']) : 0;
                    $time_out_departure = isset($timeOut['time_transaction']) ? strtotime($timeOut['time_transaction']) : 0;

                    $time_from = strtotime($list['time_from']);

                    if (isset($timeIn['time_transaction'])) {
                        $time_Arr = date('h:i A', strtotime($timeIn['time_transaction']));
                        if ($time_in_arrival > $time_from) {
                            $bgColorIn = 'bg-warning'; // Change to your desired color for late
                        } else {
                            $bgColorIn = ''; // No special background color if not late
                        }
                    } else {
                        $time_Arr = 'No Time-In';
                        $bgColorIn = 'bg-danger';
                    }

                    if (isset($timeOut['time_transaction'])) {
                        $time_Dep = date('h:i A', strtotime($timeOut['time_transaction']));
                        $bgColorOut = '';
                    } else {
                        $time_Dep = 'No Time-Out';
                        $bgColorOut = 'bg-danger';
                    }

                    $time_in = '<span class="time_attendance '.$bgColorIn.'">'.$time_Arr.'</span>';
                    $time_out = '<span class="time_attendance '.$bgColorOut.'">'.$time_Dep.'</span>';
                    $present = '<i class="bi bi-check-circle-fill text-success"></i>';
                    $total_present++;

                    // Calculate late hours and late minutes
                    if ($time_in_arrival > $time_from) {
                        $late_seconds = $time_in_arrival - $time_from;
                        $late_hours = floor($late_seconds / 3600);
                        $late_minutes = floor(($late_seconds % 3600) / 60);
                        $total_late++;
                    } else {
                        $late_hours = 0;
                        $late_minutes = 0;
                    }

                    if ($late_hours != 0 || $late_minutes != 0) {
                        $late = '<i class="bi bi-check-circle-fill text-warning"></i>';
                    } else {
                        $late = '';
                    }
                }
            } else {
                $dateToday = date('Y-m-d');
                if ($dateToday > $list['schedule_date']) {
                    $late_hours = '--';
                    $late_minutes = '--';
                    $late = '';
                    $total_hours = '--';
                    $total_minutes = '--';
                    $total_absent++;
                } else {
                    $absent = '';
                    $time_in = '';
                    $time_out = '';
                    $late_hours = '';
                    $late_minutes = '';
                    $late = '';
                    $total_hours = '';
                    $total_minutes = '';
                }
            }
        }

        $output = array(
            'total_attendance' => $total_present,
            'total_late' => $total_late,
            'total_absent' => $total_absent,
        );
        echo json_encode($output);
    }

    public function getAttendanceLogs($page = 0) {
        $output = '';
        $error = '';
        $config = array();
        $config["base_url"] = base_url() . "portal/student_portal/main/getAttendanceLogs/";
        $config["total_rows"] = $this->main_model->get_attendance_count();
        $config["per_page"] = 3;
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
    
        $schedule = $this->main_model->get_student_schedule_record($config["per_page"], $page);
    
        if ($schedule->num_rows() > 0) {
            foreach($schedule->result_array() as $list) {
                $time_in = $list['time_in'] ? date('h:i A', strtotime($list['time_in'])) : 'No Time-In';
                $time_out = $list['time_out'] ? date('h:i A', strtotime($list['time_out'])) : 'No Time-Out';
                $status = $list['time_in'] ? 'Present' : 'Absent';
    
                if ($time_in != 'No Time-In' && strtotime($time_in) > strtotime($list['time_from'])) {
                    $status = 'Late';
                }

                if($status == 'Late') {
                    $badgColor = "recent-attendance__badge--warning";
                } elseif ($status == 'Absent') {
                    $badgColor = "recent-attendance__badge--danger";
                } else {
                    $badgColor = "recent-attendance__badge--success";
                }

                $output .= '
                    <div class="col">
                        <div class="overview-card recent-attendance__card-container">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="recent-attendance__date">'.strtoupper(date('F j, Y', strtotime($list['schedule_date']))).'</div>
                                <div class="'.$badgColor.'">'.$status.'</div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-4 ">
                                <div class="d-flex flex-column gap-1">
                                    <div class="recent-attendance__time-title">Check In Time</div>
                                    <div class="recent-attendance__time">'.$time_in.'</div>
                                </div>
                                <div class="d-flex flex-column gap-1">
                                    <div class="recent-attendance__time-title">Check Out Time</div>
                                    <div class="recent-attendance__time">'.$time_out.'</div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }
        } else {
            $error .= '
                <div class="alert alert-danger"><i class="bi bi-info-circle me-2"></i>No record found.</div>
            ';
        }
    
        $data['attendance_logs'] = $output;
        $data['error'] = $error;
        echo json_encode($data);
    }
    

}
//End CI_Controller