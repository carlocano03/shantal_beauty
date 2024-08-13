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
        $lates = $this->check_lates();
        $data['total_late'] = count($lates) > 0;

        $data['late_rules'] = $this->main_model->getActiveRules();
        $data['student_info'] = $this->main_model->get_row('scholarship_member', array('user_id' => $this->session->userdata('scholarIn')['user_id']));
        $late_rules = $data['late_rules']->row();
        $no_days = isset($late_rules->no_days) ? $late_rules->no_days : 0;

        $data['letter'] = $this->main_model->get_row('uploaded_consecutive_late', array('member_id' => $this->session->userdata('scholarIn')['member_id'], 'remarks' => 'For Validation'));

        // $student_time_in = $this->main_model->get_time_in($this->session->userdata('scholarIn')['member_id']);
        // $expected_time_in = isset($student_time_in->time_in) ? $student_time_in->time_in : '';

        $schedules = $this->main_model->get_time_in($this->session->userdata('scholarIn')['member_id']);
        $total_late_count = 0;

        foreach ($schedules as $list) {
            $attendance = $this->main_model->get_attendance_record($list['schedule_date']);
            $attendance_row = $attendance->row_array();

            $timeIn = $this->main_model->get_attendance_data($list['schedule_date'], 'Time-In', $no_days);

            if ($attendance->num_rows() > 0) {
                if (is_array($attendance_row) && !empty($attendance_row)) {
                    $time_in_arrival = isset($timeIn['time_transaction']) ? strtotime($timeIn['time_transaction']) : 0;

                    $time_from = strtotime($list['time_from']);

                    // Calculate late hours and late minutes
                    if ($time_in_arrival > $time_from) {
                        $late_seconds = $time_in_arrival - $time_from;
                        $late_hours = floor($late_seconds / 3600);
                        $late_minutes = floor(($late_seconds % 3600) / 60);
                        $total_late_count++;
                    } else {
                        $late_hours = 0;
                        $late_minutes = 0;
                    }
                }
            }
            // $late_result = $this->main_model->get_total_late_count($this->session->userdata('scholarIn')['member_id'], $expected_time_in, $no_days);

            // $total_late_count += $late_result->late_count;
        }

        //$late_result = $this->main_model->get_total_late_count($this->session->userdata('scholarIn')['member_id'], $expected_time_in, $no_days);

        $data['late_count'] = $total_late_count;

        if ($total_late_count >= $late_rules->no_late) {
        //if ($total_late_count >= 1) {
            $data['show_upload_button'] = 'Show';
        } else {
            $data['show_upload_button'] = 'Hide';
        }

        $data['home_url'] = base_url('student/portal');
        $data['active_page'] = 'dashboard_page';
        $data['card_title'] = 'Dashboard';
        $data['icon'] = 'bi bi-speedometer2';
        $this->load->view('student_portal/partial/_header', $data);
        $this->load->view('student_portal/dashboard', $data);
        $this->load->view('student_portal/partial/_footer', $data);
    }

    private function check_lates() {
        $member_id = $this->session->userdata('scholarIn')['member_id'];

        //Get No of lates
        $late_rules = $this->main_model->get_row('late_rules', array('status' => 0));

        $no_days = isset($late_rules['no_days']) ? $late_rules['no_days'] : '0';

        $attendance_data = $this->main_model->get_attendance_last_90_days($member_id, $no_days);

        $lates = [];

        foreach ($attendance_data as $record) {
            $schedule_date = $record['schedule_date'];
            $time_from = strtotime($record['time_from']);
            $time_in_record = $this->main_model->get_attendance_record_data($member_id, $schedule_date);

            if (count($time_in_record) > 0) {
                $time_in = strtotime($time_in_record[0]['time_transaction']);
                if ($time_in > $time_from) {
                    if (!$this->main_model->get_uploaded_letter($member_id, $schedule_date)) {
                        $lates[] = $schedule_date;
                    }
                }
            }
        }

        return $lates;
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

    function upload_attachment()
    {
        if (isset($_FILES["attachment"]))
        {
            $dt = Date('His');
            $extension = explode('.', $_FILES['attachment']['name']);
            $new_name = rand() . 'letter_' . $dt . '.' . $extension[1];
            $destination = 'assets/uploaded_attachment/excuse_letter/' . $new_name;
            move_uploaded_file($_FILES['attachment']['tmp_name'], $destination);
            return $new_name;
        } 
    }

    public function save_excuse_letter()
    {
        $success = '';
        $error = '';

        $member_id = $this->session->userdata('scholarIn')['member_id'];
        $attachment = $this->upload_attachment();

        $upload_letter = array(
            'member_id'         => $member_id,
            'attachment'        => $attachment,
            'remarks'           => 'For Validation',
            'date_created'      => date('Y-m-d H:i:s'),
        );

        $result = $this->main_model->upload_letter_late($upload_letter);
        if ($result == TRUE) {
            $success = 'Excuse letter successfully submitted.';
        } else {
            $error = 'Failed to upload the excuse letter.';
        }
        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }
    

}
//End CI_Controller