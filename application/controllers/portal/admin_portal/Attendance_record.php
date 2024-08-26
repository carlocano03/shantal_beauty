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

class Attendance_record extends MY_Controller
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
        $this->load->model('portal/admin_portal/attendance_record_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('adminIn', 'login');
    } //End __construct

    public function index()
    {
        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/portal');
        $data['active_page'] = 'attendance_page';
        $data['card_title'] = 'Attendance Management';
        $data['icon'] = 'bi bi-calendar-week-fill';
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
        $this->load->view('admin_portal/attendance_record', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function manage_attendance()
    {
        $member_id = $this->cipher->decrypt($_GET['scholar']);
        $data['url_action'] = base_url('admin/attendance-record/manage-record?scholar=');
        $data['record'] = $this->attendance_record_model->view_scholar($member_id);
        $data['record_prev'] = $this->attendance_record_model->view_attendance_prev($member_id);
        $data['record_next'] = $this->attendance_record_model->view_attendance_next($member_id);

        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/portal');
        $data['active_page'] = 'attendance_page';
        $data['card_title'] = 'Manage Attendance';
        $data['icon'] = 'bi bi-calendar-week-fill';
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
        $this->load->view('admin_portal/manage_attendance', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function get_student_list()
    {
        $student = $this->attendance_record_model->get_student_list();
        $data = array();
        $no = $_POST['start'];

        $late_rules = $this->attendance_record_model->getActiveRules();
        $no_days = isset($late_rules->no_days) ? $late_rules->no_days : 0;
        $no_late = isset($late_rules->no_late) ? $late_rules->no_late : 0;
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

            $schedules = $this->attendance_record_model->get_time_in($list->member_id);
            $total_late_count = 0;
            foreach ($schedules as $schedList) {
                $attendance = $this->attendance_record_model->get_attendance_data($list->member_id, $schedList['schedule_date']);
                $attendance_row = $attendance->row_array();

                $timeIn = $this->attendance_record_model->get_attendance_time($list->member_id, $schedList['schedule_date'], 'Time-In', $no_days);
                if ($attendance->num_rows() > 0) {
                    if (is_array($attendance_row) && !empty($attendance_row)) {
                        $time_in_arrival = isset($timeIn['time_transaction']) ? strtotime($timeIn['time_transaction']) : 0;
    
                        $time_from = strtotime($schedList['time_from']);
    
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
            }

            $row[] = '<span class="text-danger fw-bold">'.$total_late_count.'</span> / <span class="fw-bold">'.$no_late.'</span>';
            //if ($total_late_count >= $no_late) {
            if ($total_late_count >= 1) {
                $verifyLetter = '<li><a class="dropdown-item link-cursor text-info verify_letter" data-id="'.$list->member_id.'"><i class="bi bi-download me-2"></i>Verify Letter</a></li>';
                $showButton = 'Show';
            } else {
                $verifyLetter = '';
                $showButton = 'Hide';
            }
            
            //Check the student schedule
            $schedule = $this->attendance_record_model->check_student_schedule($list->member_id);
            $schedule_row_count = $schedule->num_rows();
            $schedule_row = $schedule->row_array();

            if($schedule_row_count > 0) {
                $action = '
					<div class="d-block d-lg-none">
						<i class="fa-solid fa-circle-plus viewStudentAttendanceRecordDetailsBtn" 
						data-bs-toggle="modal"
						data-member-id="'.$member_id.'"
                        data-late_count="'.$total_late_count.'"
                        data-no_late="'.$no_late.'"
                        data-show_button="'.$showButton.'"
						data-bs-target="#viewAttendanceRecordTableDetails"
						></i>
					</div>		
                    <div class="btn-group d-none d-lg-block">
                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item link-cursor text-primary manage_attendance" data-id="'.$member_id.'"><i class="bi bi-view-list me-2"></i>Manage Attendance</a></li>
                            <li><a class="dropdown-item link-cursor text-danger view_schedule" data-id="'.$list->member_id.'"><i class="bi bi-calendar-week-fill me-2"></i>View Schedule</a></li>
                            '.$verifyLetter.'
                        </ul>
                    </div>
                ';

                $sched_id = $schedule_row['sched_id'];
                $color_mapping = [
                    '1' => 'bg-success',
                    '2' => 'bg-warning',
                ];
                $badge_color = isset($color_mapping[$sched_id]) ? $color_mapping[$sched_id] : 'bg-primary';
                $church_schedule = '<span class="badge ' . $badge_color . '">' . $schedule_row['schedule_name'] . '</span>';
            } else {
                $action = '
					<div class="d-block d-lg-none">
						<i class="fa-solid fa-circle-plus viewStudentAttendanceRecordDetailsBtn" 
						data-bs-toggle="modal"
						data-member-id="'.$member_id.'"
                        data-late_count="'.$total_late_count.'"
                        data-no_late="'.$no_late.'"
                        data-show_button="'.$showButton.'"
						data-bs-target="#viewAttendanceRecordTableDetails"
						></i>
					</div>
		
                    <div class="btn-group d-none d-lg-block">
                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item link-cursor text-primary manage_attendance" data-id="'.$member_id.'"><i class="bi bi-view-list me-2"></i>Manage Attendance</a></li>
                            '.$verifyLetter.'
                        </ul>
                    </div>
                ';
                $church_schedule = '<span class="badge bg-danger">No Schedule Selected</span>';
            }

            $row[] = $church_schedule;
            $row[] = $list->year_level;
            $row[] = ucwords($list->course);
            $row[] = $action;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->attendance_record_model->count_all(),
            "recordsFiltered" => $this->attendance_record_model->count_filtered(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

	public function get_student_details(){
		$member_id_encrypted = $this->input->get("member_id");
		$member_id = $this->cipher->decrypt($member_id_encrypted);

		$student = $this->attendance_record_model->get_student_by_id($member_id);

		if($student){
			$img = base_url().'assets/images/avatar-default-0.png';
			if(!empty($student->personal_photo) && file_exists('./assets/uploaded_attachment/personal_photo/'.$student->personal_photo)){
				$img = base_url()."assets/uploaded_attachment/personal_photo/".$student->personal_photo;
			}
			//Check the student schedule
			$schedule = $this->attendance_record_model->check_student_schedule($student->member_id);
			$schedule_row_count = $schedule->num_rows();
			$schedule_row = $schedule->row_array();


			if($schedule_row_count > 0) {
				$sched_id = $schedule_row['sched_id'];
				$color_mapping = [
					'1' => 'bg-success',
					'2' => 'bg-warning',
				];
				$badge_color = isset($color_mapping[$sched_id]) ? $color_mapping[$sched_id] : 'bg-primary';
				$church_schedule = '<span class="badge ' . $badge_color . '">' . $schedule_row['schedule_name'] . '</span>';
			} else {
				$church_schedule = '<span class="badge bg-danger">No Schedule Selected</span>';
			}

			$data = array(
				'img' => $img,
				"scholarship_no" => $student->scholarship_no,
				"name" => ucfirst($student->student_last_name.', '.ucfirst($student->student_first_name).' '.ucfirst($student->student_middle_name)),
				"schedule" => $church_schedule,
				"year_level" => $student->member_id,
				"course" => ucwords($student->course),
				"member_id" => $student->member_id,
                "schedule_count" => $schedule_row_count,
			);
			
		} else {
			echo json_encode(array('error' => 'Student not found.'));
		}
		echo json_encode($data);

		
	}

    public function check_month_attendance()
    {
        $error = '';
        $member_id = $this->cipher->decrypt($this->input->post('member_id', true));
        $month = $this->input->post('month', true);
        $month_obj = date('F Y', strtotime($month));

        $check_attendance_schedule = $this->attendance_record_model->check_attendance_schedule($member_id, $month);
        if ($check_attendance_schedule) {
            $error = '';
        } else {
            $error = 'No schedule found for the month of '.$month_obj;
        }
        $output['error'] = $error;
        echo json_encode($output);
    }

    public function getAttendanceRecord()
    {
        $output = '';
        $date_sched = '';
        $member_id = $this->input->post('member_id', true);
        $month = $this->input->post('month', true);
        $start_dt = date('Y-m-01', strtotime($month));
        $end_date_obj = date('Y-m-t', strtotime($month));

        $check_sched = $this->attendance_record_model->check_schedule($member_id, $start_dt, $end_date_obj);
        if ($check_sched->num_rows() > 0) {
            $date_sched = 'Church Schedule for the month of '.date('F Y');
			$output .= '<div class="scrollable-table" style="overflow-x:auto;">';
            $output .= '<table class="tbl_schedule" style="min-width:1100px;">';
            $output .= '
                            <tr>
                                <th class="fw-bold" style="padding:14px 10px !important; background: #222f3e; font-size:12px; color: #fff !important;" rowspan="3">DATE</th>
                                <th class="fw-bold" style="padding:14px 12px  !important; background: #222f3e; font-size:12px; color: #fff !important;" rowspan="3">DAY</th>
                                <th class="fw-bold" style="padding:16px 0 !important; background: #222f3e; font-size:12px; color: #fff !important;" colspan="4">REGULAR TIME</th>
                                <th class="fw-bold" style="padding:16px 0 !important; background: #222f3e; font-size:12px; color: #fff !important;" colspan="2">TOTAL TIME</th>
                                <th class="fw-bold" style="padding:16px 0 !important; background: #222f3e; font-size:12px; color: #fff !important;" colspan="2">TARDINESS</th>
                                <th class="fw-bold" style="padding:16px 0 !important; background: #222f3e; font-size:12px; color: #fff !important;"colspan="2">UNDERTIME</th>
                                <th class="fw-bold" style="padding:16px 0 !important; background: #222f3e; font-size:12px; color: #fff !important;" rowspan="3">PRESENT</th>
                                <th class="fw-bold" style="padding:16px 0 !important; background: #222f3e; font-size:12px; color: #fff !important;" rowspan="3">ABSENT</th>
                                <th class="fw-bold" style="padding:16px 6px !important; background: #222f3e; font-size:12px; color: #fff !important;"rowspan="3" rowspan="3">LT/UT</th>
                                <th class="fw-bold" style="padding:16px 0 !important; background: #222f3e; font-size:12px; color: #fff !important; width:13%" rowspan="3">ACTION</th>
                            </tr>
                            <tr>
                                <th class="fw-bold" style="font-size:10px; padding:10px 0 !important; background: #4a5667; color: #fff !important;" colspan="2">Arrival</th>
                                <th class="fw-bold" style="font-size:10px; padding:10px 0 !important; background: #4a5667; color: #fff !important;" colspan="2">Departure</th>
                                <th class="fw-bold" style="font-size:10px; padding:10px 0 !important; background: #4a5667; color: #fff !important;" rowspan="2">Hours</th>
                                <th class="fw-bold" style="font-size:10px; padding:10px 0 !important; background: #4a5667; color: #fff !important;" rowspan="2">Minutes</th>
                                <th class="fw-bold" style="font-size:10px; padding:10px 0 !important; background: #4a5667; color: #fff !important;"rowspan="2">Hours</th>
                                <th class="fw-bold" style="font-size:10px; padding:10px 0 !important; background: #4a5667; color: #fff !important;"rowspan="2">Minutes</th>
                                <th class="fw-bold" style="font-size:10px; padding:10px 0 !important; background: #4a5667; color: #fff !important;" rowspan="2">Hours</th>
                                <th class="fw-bold" style="font-size:10px; padding:10px 0 !important; background: #4a5667; color: #fff !important;" rowspan="2">Minutes</th>
                            </tr>
                            <tr>
                                <th style="font-size:9px; background: #6f7c91; color: #fff !important;">Time-In</th>
                                <th style="font-size:9px; background: #6f7c91; color: #fff !important;">Schedule</th>
                                <th style="font-size:9px; background: #6f7c91; color: #fff !important;">Time-Out</th>
                                <th style="font-size:9px; background: #6f7c91; color: #fff !important;">Schedule</th>
                            </tr>
            ';
            $output .= '<tbody">';
            $schedule = $this->attendance_record_model->get_student_schedule_list($member_id, $start_dt, $end_date_obj);
            $total_tardiness_hours = 0;
            $total_tardiness_minutes = 0;

            $total_work_hours = 0;
            $total_work_minutes = 0;
            $tardiness_hours = 0;
            $tardiness_minutes = 0;
            $underTime_hours = 0;
            $underTime_minutes = 0;

            $total_present = 0;
            $total_absent = 0;
            $total_late = 0;
            $total_undertime = 0;
            foreach($schedule->result_array() as $list) {
                $dateToday = date('Y-m-d');

                //Attendance Data
                $attendance = $this->attendance_record_model->get_attendance_record($list['member_id'], $list['schedule_date']);
                $attendance_row = $attendance->row_array();

                $timeIn = $this->attendance_record_model->get_attendance($list['member_id'], $list['schedule_date'], 'Time-In');
                $timeOut = $this->attendance_record_model->get_attendance($list['member_id'], $list['schedule_date'], 'Time-Out');

                $time_in = '';
                $time_out = '';
                $present = '';
                $absent = '';
                $late = '';

                //Uploaded excuse letter
                $letter = $this->attendance_record_model->get_excuse_letter($list['member_id'], $list['schedule_date']);
                $letter_row = $letter->row_array();
                // Reset the action variable
                $action = '';
                $brokenSched = '';
                if ($attendance->num_rows() > 0) {
                    if (is_array($attendance_row) && !empty($attendance_row)) {
                        $time_in_arrival = isset($timeIn['time_transaction']) ? strtotime($timeIn['time_transaction']) : 0;
                        $time_out_departure = isset($timeOut['time_transaction']) ? strtotime($timeOut['time_transaction']) : 0;

                        $time_from = strtotime($list['time_from']);
                        $time_to = strtotime($list['time_to']);

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
                            if ($time_out_departure < $time_to) {
                                $bgColorOut = 'bg-warning';
                            } else {
                                $bgColorOut = '';
                            }

                            // Calculate undertime hours and undertime minutes
                            if ($time_out_departure < $time_to) {
                                $undertime_seconds = $time_to - $time_out_departure;
                                $undertime_hours = floor($undertime_seconds / 3600);
                                $undertime_minutes = floor(($undertime_seconds % 3600) / 60);
                                $total_undertime++;
                            } else {
                                $undertime_hours = 0;
                                $undertime_minutes = 0;
                            }
                        } else {
                            $time_Dep = 'No Time-Out';
                            $bgColorOut = 'bg-danger';
                            $undertime_hours = 0;
                            $undertime_minutes = 0;
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

                        // Calculate total time in hours and minutes
                        if ($time_in_arrival > 0 && $time_out_departure > $time_in_arrival) {
                            $total_seconds = $time_out_departure - $time_in_arrival;
                            $total_hours = floor($total_seconds / 3600);
                            $total_minutes = floor(($total_seconds % 3600) / 60);
                        } else {
                            $total_hours = 0;
                            $total_minutes = 0;
                        }

                        if ($late_hours != 0 || $late_minutes != 0 || $undertime_hours != 0 || $undertime_minutes != 0) {
                            if ($letter->num_rows() > 0) {
                                if (is_array($letter_row) && !empty($letter_row)) {
                                    if ($letter_row['remarks'] == 'For Validation') {
                                        $action = '<button class="btn btn-outline-primary btn-xs validate_letter" data-action="Late" data-id="'.$list['member_id'].'" data-date="'.$list['schedule_date'].'"><i class="bi bi-check2-circle me-1"></i>Validate Letter</button>';
                                    } else {
                                        $color_mapping = [
                                            'Valid' => 'bg-success',
                                            'Invalid' => 'bg-danger',
                                        ];
                                        $badge_color = isset($color_mapping[$letter_row['remarks']]) ? $color_mapping[$letter_row['remarks']] : 'bg-primary';
                                        if ($letter_row['remarks'] == 'Valid') {
                                            $action = '<span class="badge ' . $badge_color . ' px-2 mb-1">' . $letter_row['remarks'] . ' Letter</span>' . 
                                                      '<div class="badge bg-info"><i class="bi bi-check2-square me-1"></i>With 1,000 Allowance</div>';
                                        } else {
                                            $action = '<span class="badge ' . $badge_color . ' px-2">' . $letter_row['remarks'] . ' Letter</span>';
                                        }
                                    }
                                }
                            } else {
                                $action = '<span class="badge bg-danger"><i class="bi bi-check2-square me-1"></i>No Uploaded Letter</span>';
                            }
                        }
                        

                        if ($time_Dep != 'No Time-Out') {
                            if ($late_hours != 0 || $late_minutes != 0 || $undertime_hours != 0 || $undertime_minutes != 0) {
                                $late = '<div><i class="bi bi-check-circle-fill text-warning"></i></div>
                                         <span class="download_letter" data-action="Late" title="Download Excuse Letter" data-id="'.$list['member_id'].'" data-date="'.$list['schedule_date'].'">Download</span>';
                            } else {
                                $late = '';
                                $action = '<span class="badge bg-info"><i class="bi bi-check2-square me-1"></i>With 1,000 Allowance</span>';
                            }
                        }
                        
                    }
                } else {
                    if ($dateToday > $list['schedule_date']) {
                        $time_in = '<span class="font-weight-bold text-danger">--:--:--</span>';
                        $time_out = '<span class="font-weight-bold text-danger">--:--:--</span>';
                        $late_hours = '--';
                        $late_minutes = '--';
                        $undertime_hours = '--';
                        $undertime_minutes = '--';
                        $late = '';
                        $total_hours = '--';
                        $total_minutes = '--';
                        $total_absent++;

                        if ($letter->num_rows() > 0) {
                            if (is_array($letter_row) && !empty($letter_row)) {
                                if ($letter_row['remarks'] == 'For Validation') {
                                    $action = '<button class="btn btn-outline-primary btn-xs validate_letter" data-action="Absent" data-id="'.$list['member_id'].'" data-date="'.$list['schedule_date'].'"><i class="bi bi-check2-circle me-1"></i>Validate Letter</button>';
                                } else {
                                    $color_mapping = [
                                        'Valid' => 'bg-success',
                                        'Invalid' => 'bg-danger',
                                    ];
                                    $badge_color = isset($color_mapping[$letter_row['remarks']]) ? $color_mapping[$letter_row['remarks']] : 'bg-primary';
                                    $action = '<span class="badge ' . $badge_color . ' px-2">' . $letter_row['remarks'] . ' Letter</span>';
                                }
                            }
                        } else {
                            $action = '<span class="badge bg-danger"><i class="bi bi-check2-square me-1"></i>No Uploaded Letter</span>';
                        }

                        $absent = '<div><i class="bi bi-check-circle-fill text-danger"></i></div>
                                   <span class="download_letter" data-action="Absent" title="Download Excuse Letter" data-id="'.$list['member_id'].'" data-date="'.$list['schedule_date'].'">Download</span>';
                    } else {
                        $absent = '';
                        $time_in = '';
                        $time_out = '';
                        $late_hours = '';
                        $late_minutes = '';
                        $undertime_hours = '';
                        $undertime_minutes = '';
                        $late = '';
                        $total_hours = '';
                        $total_minutes = '';

                        $currentMonth = date('Y-m');
                        if ($month > $currentMonth) {
                            $brokenSched = '';
                        } else {
                            if ($dateToday >= $list['schedule_date']) { 
                                $brokenSched = '';
                            } else {
                                $brokenSched = 'Broken Sched';
                            }
                        }
                        
                    }
                }

                if ($list['remarks'] == 'Broken Schedule') {
                    $view = 'View';
                } else {
                    $view = '';
                }

                $output .= '
                            <tr>
                                <td class="fw-bold">
                                    <div>'.strtoupper(date('M-d', strtotime($list['schedule_date']))).'</div>
                                    <span title="View broken schedule" class="broken_schedule" id="view_broken_sched"
                                        data-remarks="'.$list['remarks'].'"
                                        data-comment="'.$list['comment'].'"
                                        data-date_change="'.date('D M j, Y h:i A', strtotime($list['date_updated'])).'"
                                    >'.$view.'</span>
                                </td>
                                <td class="fw-bold">'.strtoupper(date('D', strtotime($list['day_name']))).'</td>
                                <td>'.$time_in.'</td>
                                <td class="fw-bold">
                                    <div>'.date('h:i A', strtotime($list['time_from'])).'</div>
                                    <span title="Apply broken schedule" class="broken_schedule" id="broken_schedule" data-member="'.$list['member_id'].'" data-id="'.$list['selected_schedule_id'].'" data-sched="'.$list['time_from'].'">'.$brokenSched.'</span>
                                </td>
                                <td>'.$time_out.'</td>
                                <td class="fw-bold">'.date('h:i A', strtotime($list['time_to'])).'</td>
                                <td>'.$total_hours.'</td>
                                <td>'.$total_minutes.'</td>
                                <td>'.$late_hours.'</td>
                                <td>'.$late_minutes.'</td>
                                <td>'.$undertime_hours.'</td>
                                <td>'.$undertime_minutes.'</td>
                                <td>'.$present.'</td>
                                <td>'.$absent.'</td>
                                <td>'.$late.'</td>
                                <td>'.$action.'</td>
                            </tr>
                ';

                if (is_numeric($total_hours) && is_numeric($total_minutes)) {
                    //Regular Sched
                    $total_work_hours += $total_hours;
                    $total_work_minutes += $total_minutes;
                }

                if (is_numeric($late_hours) && is_numeric($late_minutes)) {
                    //Tardiness
                    $tardiness_hours += $late_hours;
                    $tardiness_minutes += $late_minutes;
                }

                if (is_numeric($undertime_hours) && is_numeric($undertime_minutes)) {
                    //Tardiness
                    $underTime_hours += $undertime_hours;
                    $underTime_minutes += $undertime_minutes;
                }
            }

            $output .= '</tbody">';

            //Regular Work
            $total_work_time = 0;
            $remaining_hours = 0;
            $remaining_minutes = 0;
            $total_work_time += $total_work_hours;
            $remaining_hours = $total_work_minutes / 60;
            $remaining_minutes = $total_work_minutes % 60;
            $total_work_time += (int)($remaining_hours);

            //Tardiness
            $tardiness_time = 0;
            $remaining_late_hours = 0;
            $remaining_late_minutes = 0;
            $tardiness_time += $tardiness_hours;
            $remaining_late_hours = $tardiness_minutes / 60; 
            $remaining_late_minutes = $tardiness_minutes % 60; 
            $tardiness_time += (int)($remaining_late_hours);

            //Undertime
            $undertime_time = 0;
            $remaining_undertime_hours = 0;
            $remaining_undertime_minutes = 0;
            $undertime_time += $underTime_hours;
            $remaining_undertime_hours = $underTime_minutes / 60; 
            $remaining_undertime_minutes = $underTime_minutes % 60; 
            $undertime_time += (int)($remaining_undertime_hours);

            $output .= '
                        <tfoot>
                            <tr>
                                <td colspan="6" style="background: #6f7c91; color: #fff;"></td>
                                <td colspan="2" style="background: #4a5667; color: #fff; font-weight:bold;"><i class="bi bi-clock me-1"></i>'.$total_work_time.'h '.$remaining_minutes.'m</td>
                                <td colspan="2" style="background: #4a5667; color: #fff; font-weight:bold;"><i class="bi bi-clock me-1"></i>'.$tardiness_time.'h '.$remaining_late_minutes.'m</td>
                                <td colspan="2" style="background: #4a5667; color: #fff; font-weight:bold;"><i class="bi bi-clock me-1"></i>'.$undertime_time.'h '.$remaining_undertime_minutes.'m</td>
                                <td style="background: #222f3e; color: #fff; font-weight:bold;">'.$total_present.'</td>
                                <td style="background: #222f3e; color: #fff; font-weight:bold;">'.$total_absent.'</td>
                                <td style="background: #222f3e; color: #fff; font-weight:bold;">'.$total_late.'</td>
                                <td colspan="3" style="background: #6f7c91; color: #fff;"></td>
                            </tr>
                        </tfoot>
            ';

            $output .= '</table">';
            $output .= '</div">';

        } else {
            $output .= '<div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>No schedule selected.</div>';
        }
        $data = array(
            'attendance' => $output,
            'date_sched' => $date_sched,
        );
        echo json_encode($data);
    }


    public function download_excuse_letter()
    {
        $this->load->helper('url');
        $this->load->helper('download');

        $action = $this->input->post('action', true);
        $member_id = $this->input->post('member_id', true);
        $attendance_date = $this->input->post('attendance_date', true);

        $fileinfo = $this->attendance_record_model->download_excuse_letter($member_id, $attendance_date, $action); 
        if (!$fileinfo) {
            $this->output
                ->set_status_header(404)
                ->set_output(json_encode(array('error' => 'File not found')));
            return;
        }

        $filename = $fileinfo['attachment'];
        $file_path = FCPATH . 'assets/uploaded_attachment/excuse_letter/' . $filename;

        if (file_exists($file_path)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename=' . $filename);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));
            ob_clean();
            flush();
            readfile($file_path);
            exit;
        } else {
            $this->output
                ->set_status_header(404)
                ->set_output(json_encode(array('error' => 'File not found')));
        }
    }

    public function save_validation()
    {
        $success = '';
        $error = '';
        $remarks = $this->input->post('remarks', true);
        $member_id = $this->input->post('member_id', true);
        $schedule_date = $this->input->post('schedule_date', true);
        $validation = $this->input->post('validation', true);

        $update_letter = array(
            'remarks' => $validation,
            'date_updated' => date('Y-m-d H:i:s'),
        );

        $result = $this->attendance_record_model->save_validation($update_letter, $remarks, $member_id, $schedule_date);
        if ($result == TRUE) {
            $member = $this->attendance_record_model->get_row('scholarship_member', array('member_id' => $member_id));
            $logs = array(
                'user_id'       => $this->session->userdata('adminIn')['user_id'],
                'user_type_id'  => $this->session->userdata('adminIn')['user_type_id'],
                'transaction'   => 'Validate the excuse letter of '.$member['scholarship_no'],
                'remarks'       => 'Validate',
                'email_use'     => $this->session->userdata('adminIn')['email_add'],
            );
            $this->insert_activity_logs($logs);

            $success = 'Excuse letter successfully validated.';
        } else {
            $error = 'Failed to validate the letter.';
        }
        $output = array(
            'error' => $error,
            'success' => $success
        );
        echo json_encode($output);
    }

    public function view_schedule()
    {
        $output = '';
        $member_id = $this->input->post('member_id', true);

        $scholar = $this->attendance_record_model->get_row('scholarship_member', array('member_id' => $member_id, 'status' => 0));
        $scholar_name = $scholar['student_last_name'].', '.$scholar['student_first_name'].' '.$scholar['student_middle_name'];

        $output .= '
            <div class="d-flex align-items-center justify-content-between" style="font-size:13px;">
                <div class="fw-bold">Scholarship No.:</div>
                <div class="scholarship_no">'.$scholar['scholarship_no'].'</div>
            </div>
            <hr class="mt-2 mb-2">
            <div class="d-flex align-items-center justify-content-between" style="font-size:13px;">
                <div class="fw-bold">Scholar Name.:</div>
                <div class="full_name">'.ucwords($scholar_name).'</div>
            </div>
            <hr class="mt-2 mb-2">
        ';

        $output .= '
            <div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>List of Schedules</div>
            <table class="tbl_sched">
                <tr>
                    <th>Date</th>
                    <th class="text-center">Time From</th>
                    <th class="text-center">Time To</th>
                    <th class="text-center">Day</th>
                </tr>
                <tbody>
        ';

        $schedule = $this->attendance_record_model->get_selected_schedule($member_id);
        foreach($schedule as $list) {
            $output .= '
                    <tr>
                        <td>'.date('F j, Y', strtotime($list->schedule_date)).'</td>
                        <td class="text-center">'.date('h:i A', strtotime($list->time_from)).'</td>
                        <td class="text-center">'.date('h:i A', strtotime($list->time_to)).'</td>
                        <td class="text-center">'.$list->day_name.'</td>
                    </tr>
            ';
        }
        $output .= '
                </tbody>
            </table>
        ';

        $data = array(
            'scholar_schedule' => $output,
        );
        echo json_encode($data);
    }

    public function print_attendance()
    {
        require_once 'vendor/autoload.php';
        $member_id = $this->cipher->decrypt($this->input->get('scholar'));
        $month = $this->input->get('month');
        $start_dt = date('Y-m-01', strtotime($month));
        $end_date_obj = date('Y-m-t', strtotime($month));

        $output = '';
        $mpdf = new \Mpdf\Mpdf( [ 
            'format' => 'A4-L',
            'margin_top' => 5,
            'margin_left' => 5,
            'margin_right' => 2,
            'margin_bottom' => 5,
        ]);

        $output .= '
            <table class="tbl_schedule">
                <tr>
                    <th style="background: #222f3e; color: #fff;" rowspan="3">DATE</th>
                    <th style="background: #222f3e; color: #fff;" rowspan="3">DAY</th>
                    <th style="background: #222f3e; color: #fff;" colspan="4">REGULAR TIME</th>
                    <th style="background: #222f3e; color: #fff;" colspan="2">TOTAL TIME</th>
                    <th style="background: #222f3e; color: #fff;" colspan="2">TARDINESS</th>
                    <th style="background: #222f3e; color: #fff;" colspan="2">UNDERTIME</th>
                    <th style="background: #222f3e; color: #fff;" rowspan="3">PRESENT</th>
                    <th style="background: #222f3e; color: #fff;" rowspan="3">ABSENT</th>
                    <th style="background: #222f3e; color: #fff;" rowspan="3">LT/UT</th>
                    <th style="background: #222f3e; color: #fff; width:13%;" rowspan="3">REMARKS</th>
                </tr>
                <tr>
                    <th style="font-size:9px; background: #353b48; color: #fff;" colspan="2">Arrival</th>
                    <th style="font-size:9px; background: #353b48; color: #fff;" colspan="2">Departure</th>
                    <th style="font-size:9px; background: #353b48; color: #fff;" rowspan="2">Hours</th>
                    <th style="font-size:9px; background: #353b48; color: #fff;" rowspan="2">Minutes</th>
                    <th style="font-size:9px; background: #353b48; color: #fff;" rowspan="2">Hours</th>
                    <th style="font-size:9px; background: #353b48; color: #fff;" rowspan="2">Minutes</th>
                    <th style="font-size:9px; background: #353b48; color: #fff;" rowspan="2">Hours</th>
                    <th style="font-size:9px; background: #353b48; color: #fff;" rowspan="2">Minutes</th>
                </tr>
                <tr>
                    <th style="font-size:9px; background: #576574; color: #fff;">Time-In</th>
                    <th style="font-size:9px; background: #576574; color: #fff;">Schedule</th>
                    <th style="font-size:9px; background: #576574; color: #fff;">Time-Out</th>
                    <th style="font-size:9px; background: #576574; color: #fff;">Schedule</th>
                </tr>
        ';

        $schedule = $this->attendance_record_model->get_student_schedule_list($member_id, $start_dt, $end_date_obj);
        $total_tardiness_hours = 0;
        $total_tardiness_minutes = 0;

        $total_work_hours = 0;
        $total_work_minutes = 0;
        $tardiness_hours = 0;
        $tardiness_minutes = 0;
        $underTime_hours = 0;
        $underTime_minutes = 0;

        $total_present = 0;
        $total_absent = 0;
        $total_late = 0;
        $total_undertime = 0;
        foreach($schedule->result_array() as $list) {
            //Attendance Data
            $attendance = $this->attendance_record_model->get_attendance_record($list['member_id'], $list['schedule_date']);
            $attendance_row = $attendance->row_array();

            $timeIn = $this->attendance_record_model->get_attendance($list['member_id'], $list['schedule_date'], 'Time-In');
            $timeOut = $this->attendance_record_model->get_attendance($list['member_id'], $list['schedule_date'], 'Time-Out');

            $time_in = '';
            $time_out = '';
            $present = '';
            $absent = '';
            $late = '';

            //Uploaded excuse letter
            $letter = $this->attendance_record_model->get_excuse_letter($list['member_id'], $list['schedule_date']);
            $letter_row = $letter->row_array();
            // Reset the action variable
            $action = '';

            if ($attendance->num_rows() > 0) {
                if (is_array($attendance_row) && !empty($attendance_row)) {
                    $time_in_arrival = isset($timeIn['time_transaction']) ? strtotime($timeIn['time_transaction']) : 0;
                    $time_out_departure = isset($timeOut['time_transaction']) ? strtotime($timeOut['time_transaction']) : 0;

                    $time_from = strtotime($list['time_from']);
                    $time_to = strtotime($list['time_to']);

                    if (isset($timeIn['time_transaction'])) {
                        $time_Arr = date('h:i A', strtotime($timeIn['time_transaction']));
                        if ($time_in_arrival > $time_from) {
                            $bgColorIn = 'text-warning'; // Change to your desired color for late
                        } else {
                            $bgColorIn = ''; // No special background color if not late
                        }
                    } else {
                        $time_Arr = 'No Time-In';
                        $bgColorIn = 'text-danger';
                    }

                    if (isset($timeOut['time_transaction'])) {
                        $time_Dep = date('h:i A', strtotime($timeOut['time_transaction']));
                        if ($time_out_departure < $time_to) {
                            $bgColorOut = 'text-warning'; // Change to your desired color for late
                        } else {
                            $bgColorOut = ''; // No special background color if not late
                        }
                        // Calculate undertime hours and undertime minutes
                        if ($time_out_departure < $time_to) {
                            $undertime_seconds = $time_to - $time_out_departure;
                            $undertime_hours = floor($undertime_seconds / 3600);
                            $undertime_minutes = floor(($undertime_seconds % 3600) / 60);
                            $total_late++;
                        } else {
                            $undertime_hours = 0;
                            $undertime_minutes = 0;
                        }
                    } else {
                        $time_Dep = 'No Time-Out';
                        $bgColorOut = 'text-danger';
                        $undertime_hours = 0;
                        $undertime_minutes = 0;
                    }

                    $time_in = '<span class="'.$bgColorIn.'">'.$time_Arr.'</span>';
                    $time_out = '<span class="'.$bgColorOut.'">'.$time_Dep.'</span>';

                    $present = '/';
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

                    // Calculate total time in hours and minutes
                    if ($time_in_arrival > 0 && $time_out_departure > $time_in_arrival) {
                        $total_seconds = $time_out_departure - $time_in_arrival;
                        $total_hours = floor($total_seconds / 3600);
                        $total_minutes = floor(($total_seconds % 3600) / 60);
                    } else {
                        $total_hours = 0;
                        $total_minutes = 0;
                    }

            
                    if ($late_hours != 0 || $late_minutes != 0 || $undertime_hours != 0 || $undertime_minutes != 0) {
                        if ($letter->num_rows() > 0) {
                            if (is_array($letter_row) && !empty($letter_row)) {
                                if ($letter_row['remarks'] == 'For Validation') {
                                    $action = 'For Validation';
                                } else {
                                    if ($letter_row['remarks'] == 'Valid') {
                                        $action = '<span>' .$letter_row['remarks']. ' Letter</span>' . 
                                                  '<div>With 1,000 Allowance</div>';
                                    } else {
                                        $action = '<span>' .$letter_row['remarks']. ' Letter</span>';
                                    }
                                }
                            }
                        } else {
                            $action = 'No Uploaded Letter';
                        }
                        $late = '/';
                    } else {
                        $late = '';
                    }
                }
            } else {
                $dateToday = date('Y-m-d');
                if ($dateToday > $list['schedule_date']) {
                    $time_in = '<span class="text-danger">--:--:--</span>';
                    $time_out = '<span class="text-danger">--:--:--</span>';
                    $late_hours = '--';
                    $late_minutes = '--';
                    $undertime_hours = '--';
                    $undertime_minutes = '--';
                    $late = '';
                    $total_hours = '--';
                    $total_minutes = '--';
                    $total_absent++;

                    if ($letter->num_rows() > 0) {
                        if (is_array($letter_row) && !empty($letter_row)) {
                            if ($letter_row['remarks'] == 'For Validation') {
                                $action = 'For Validation';
                            } else {
                                $action = '<span>' .$letter_row['remarks']. ' Letter</span>';
                            }
                        }
                    } else {
                        $action = 'No Uploaded Letter';
                    }

                    $absent = '/';
                } else {
                    $absent = '';
                    $time_in = '';
                    $time_out = '';
                    $late_hours = '';
                    $late_minutes = '';
                    $undertime_hours = '';
                    $undertime_minutes = '';
                    $late = '';
                    $total_hours = '';
                    $total_minutes = '';
                }
            }

            $output .= '
                    <tr>
                        <td class="fw-bold">'.strtoupper(date('M-d', strtotime($list['schedule_date']))).'</td>
                        <td class="fw-bold">'.strtoupper(date('D', strtotime($list['day_name']))).'</td>
                        <td>'.$time_in.'</td>
                        <td class="fw-bold">'.date('h:i A', strtotime($list['time_from'])).'</td>
                        <td>'.$time_out.'</td>
                        <td class="fw-bold">'.date('h:i A', strtotime($list['time_to'])).'</td>
                        <td>'.$total_hours.'</td>
                        <td>'.$total_minutes.'</td>
                        <td>'.$late_hours.'</td>
                        <td>'.$late_minutes.'</td>
                        <td>'.$undertime_hours.'</td>
                        <td>'.$undertime_minutes.'</td>
                        <td>'.$present.'</td>
                        <td>'.$absent.'</td>
                        <td>'.$late.'</td>
                        <td>'.$action.'</td>
                    </tr>
                ';
                
                if (is_numeric($total_hours) && is_numeric($total_minutes)) {
                    //Regular Sched
                    $total_work_hours += $total_hours;
                    $total_work_minutes += $total_minutes;
                }

                if (is_numeric($late_hours) && is_numeric($late_minutes)) {
                    //Tardiness
                    $tardiness_hours += $late_hours;
                    $tardiness_minutes += $late_minutes;
                }

                if (is_numeric($undertime_hours) && is_numeric($undertime_minutes)) {
                    //Tardiness
                    $underTime_hours += $undertime_hours;
                    $underTime_minutes += $undertime_minutes;
                }
        }

        //Regular Work
        $total_work_time = 0;
        $remaining_hours = 0;
        $remaining_minutes = 0;
        $total_work_time += $total_work_hours;
        $remaining_hours = $total_work_minutes / 60;
        $remaining_minutes = $total_work_minutes % 60;
        $total_work_time += (int)($remaining_hours);

        //Tardiness
        $tardiness_time = 0;
        $remaining_late_hours = 0;
        $remaining_late_minutes = 0;
        $tardiness_time += $tardiness_hours;
        $remaining_late_hours = $tardiness_minutes / 60; 
        $remaining_late_minutes = $tardiness_minutes % 60; 
        $tardiness_time += (int)($remaining_late_hours);

        //Undertime
        $undertime_time = 0;
        $remaining_undertime_hours = 0;
        $remaining_undertime_minutes = 0;
        $undertime_time += $underTime_hours;
        $remaining_undertime_hours = $underTime_minutes / 60; 
        $remaining_undertime_minutes = $underTime_minutes % 60; 
        $undertime_time += (int)($remaining_undertime_hours);

        $output .= '
                    <tr>
                        <td colspan="6" style="background: #576574; color: #fff;"></td>
                        <td colspan="2" style="background: #353b48; color: #fff; font-weight:bold;"><i class="bi bi-clock me-1"></i>'.$total_work_time.'h '.$remaining_minutes.'m</td>
                        <td colspan="2" style="background: #353b48; color: #fff; font-weight:bold;"><i class="bi bi-clock me-1"></i>'.$tardiness_time.'h '.$remaining_late_minutes.'m</td>
                        <td colspan="2" style="background: #4a5667; color: #fff; font-weight:bold;"><i class="bi bi-clock me-1"></i>'.$undertime_time.'h '.$remaining_undertime_minutes.'m</td>
                        <td style="background: #222f3e; color: #fff; font-weight:bold;">'.$total_present.'</td>
                        <td style="background: #222f3e; color: #fff; font-weight:bold;">'.$total_absent.'</td>
                        <td style="background: #222f3e; color: #fff; font-weight:bold;">'.$total_late.'</td>
                        <td style="background: #576574; color: #fff;"></td>
                    </tr>
                ';

        $output .= '</table>';

        $data['tbl_data'] = $output;
        $data['attendance_month'] = 'Attendance record for the month of '.date('F Y', strtotime($month));
        $mpdf->showImageErrors = true;
        $mpdf->showWatermarkImage = true;
        $html = $this->load->view( 'admin_portal/pdf/attendance_record_pdf', $data, true);
        $mpdf->WriteHTML( $html );
        $mpdf->Output();
    }

    public function excel_attendance()
    {
        require_once 'vendor/autoload.php';
        $member_id = $this->cipher->decrypt($this->input->get('scholar'));
        $month = $this->input->get('month');
        $start_dt = date('Y-m-01', strtotime($month));
        $end_date_obj = date('Y-m-t', strtotime($month));

        $month_of = date('F Y', strtotime($month));

        $objReader = IOFactory::createReader('Xlsx');
        $fileName = 'New Attendance.xlsx';
        $newfileName = 'Attendance for the month of '.$month_of.'.xlsx';

        $spreadsheet = $objReader->load(FCPATH . '/assets/template/'. $fileName);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A2', 'Attendance for the month of '.$month_of);
        $startRow = 7;
        $currentRow = 7;

        $schedule = $this->attendance_record_model->get_student_schedule_list($member_id, $start_dt, $end_date_obj);
        $total_tardiness_hours = 0;
        $total_tardiness_minutes = 0;

        $total_work_hours = 0;
        $total_work_minutes = 0;
        $tardiness_hours = 0;
        $tardiness_minutes = 0;
        $underTime_hours = 0;
        $underTime_minutes = 0;

        $total_present = 0;
        $total_absent = 0;
        $total_late = 0;
        $total_undertime = 0;
        foreach($schedule->result_array() as $list) {
            //Attendance Data
            $attendance = $this->attendance_record_model->get_attendance_record($list['member_id'], $list['schedule_date']);
            $attendance_row = $attendance->row_array();

            $timeIn = $this->attendance_record_model->get_attendance($list['member_id'], $list['schedule_date'], 'Time-In');
            $timeOut = $this->attendance_record_model->get_attendance($list['member_id'], $list['schedule_date'], 'Time-Out');

            $time_in = '';
            $time_out = '';
            $present = '';
            $absent = '';
            $late = '';

            //Uploaded excuse letter
            $letter = $this->attendance_record_model->get_excuse_letter($list['member_id'], $list['schedule_date']);
            $letter_row = $letter->row_array();
            // Reset the action variable
            $action = '';

            if ($attendance->num_rows() > 0) {
                if (is_array($attendance_row) && !empty($attendance_row)) {
                    $time_in_arrival = isset($timeIn['time_transaction']) ? strtotime($timeIn['time_transaction']) : 0;
                    $time_out_departure = isset($timeOut['time_transaction']) ? strtotime($timeOut['time_transaction']) : 0;

                    $time_from = strtotime($list['time_from']);
                    $time_to = strtotime($list['time_to']);

                    if (isset($timeIn['time_transaction'])) {
                        $time_Arr = date('h:i A', strtotime($timeIn['time_transaction']));
                        if ($time_in_arrival > $time_from) {
                            $bgColorIn = 'text-warning'; // Change to your desired color for late
                        } else {
                            $bgColorIn = ''; // No special background color if not late
                        }
                    } else {
                        $time_Arr = 'No Time-In';
                        $bgColorIn = 'text-danger';
                    }

                    if (isset($timeOut['time_transaction'])) {
                        $time_Dep = date('h:i A', strtotime($timeOut['time_transaction']));
                        $bgColorOut = '';
                        // Calculate undertime hours and undertime minutes
                        if ($time_out_departure < $time_to) {
                            $undertime_seconds = $time_to - $time_out_departure;
                            $undertime_hours = floor($undertime_seconds / 3600);
                            $undertime_minutes = floor(($undertime_seconds % 3600) / 60);
                            $total_late++;
                        } else {
                            $undertime_hours = 0;
                            $undertime_minutes = 0;
                        }
                    } else {
                        $time_Dep = 'No Time-Out';
                        $bgColorOut = 'text-danger';
                        $undertime_hours = 0;
                        $undertime_minutes = 0;
                    }

                    $time_in = $time_Arr;
                    $time_out = $time_Dep;

                    $present = '/';
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

                    // Calculate total time in hours and minutes
                    if ($time_in_arrival > 0 && $time_out_departure > $time_in_arrival) {
                        $total_seconds = $time_out_departure - $time_in_arrival;
                        $total_hours = floor($total_seconds / 3600);
                        $total_minutes = floor(($total_seconds % 3600) / 60);
                    } else {
                        $total_hours = 0;
                        $total_minutes = 0;
                    }

                    if ($letter->num_rows() > 0) {
                        if (is_array($letter_row) && !empty($letter_row)) {
                            if ($letter_row['remarks'] == 'For Validation') {
                                $action = 'For Validation';
                            } else {
                                if ($letter_row['remarks'] == 'Valid') {
                                    $action = $letter_row['remarks'].' Letter/With 1,000 Allowance';
                                } else {
                                    $action = $letter_row['remarks'];
                                }
                            }
                        }
                    } else {
                        $action = 'No Uploaded Letter';
                    }

                    if ($late_hours != 0 || $late_minutes != 0 || $undertime_hours != 0 || $undertime_minutes != 0) {
                        $late = '/';
                    } else {
                        $late = '';
                    }
                }
            } else {
                $dateToday = date('Y-m-d');
                if ($dateToday > $list['schedule_date']) {
                    $time_in = '--:--:--';
                    $time_out = '--:--:--';
                    $late_hours = '--';
                    $late_minutes = '--';
                    $undertime_hours = '--';
                    $undertime_minutes = '--';
                    $late = '';
                    $total_hours = '--';
                    $total_minutes = '--';
                    $total_absent++;

                    if ($letter->num_rows() > 0) {
                        if (is_array($letter_row) && !empty($letter_row)) {
                            if ($letter_row['remarks'] == 'For Validation') {
                                $action = 'For Validation';
                            } else {
                                $action = $letter_row['remarks'].' Letter';
                            }
                        }
                    } else {
                        $action = 'No Uploaded Letter';
                    }

                    $absent = '/';
                } else {
                    $absent = '';
                    $time_in = '';
                    $time_out = '';
                    $late_hours = '';
                    $late_minutes = '';
                    $undertime_hours = '';
                    $undertime_minutes = '';
                    $late = '';
                    $total_hours = '';
                    $total_minutes = '';
                }
            }

            $spreadsheet->getActiveSheet()->insertNewRowBefore($currentRow+1,1);
            $spreadsheet->getActiveSheet()
                ->setCellValue('A'.$currentRow, strtoupper(date('M-d', strtotime($list['schedule_date']))))
                ->setCellValue('B'.$currentRow, strtoupper(date('D', strtotime($list['day_name']))))
                ->setCellValue('C'.$currentRow, $time_in)
                ->setCellValue('D'.$currentRow, date('h:i A', strtotime($list['time_from'])))
                ->setCellValue('E'.$currentRow, $time_out)
                ->setCellValue('F'.$currentRow, date('h:i A', strtotime($list['time_to'])))
                ->setCellValue('G'.$currentRow, $total_hours)
                ->setCellValue('H'.$currentRow, $total_minutes)
                ->setCellValue('I'.$currentRow, $late_hours)
                ->setCellValue('J'.$currentRow, $late_minutes)
                ->setCellValue('K'.$currentRow, $undertime_hours)
                ->setCellValue('L'.$currentRow, $undertime_minutes)
                ->setCellValue('M'.$currentRow, $present)
                ->setCellValue('N'.$currentRow, $absent)
                ->setCellValue('O'.$currentRow, $late)
                ->setCellValue('P'.$currentRow, $action);
            $currentRow++;
        }
        $spreadsheet->getActiveSheet()->removeRow($currentRow,1);
        $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
        header('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
        header('Content-Disposition: attachment;filename="'.$newfileName.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

    public function save_broken_sched()
    {
        $error = '';
        $success = '';
        $selected_sched_id = $this->input->post('selected_sched_id', true);
        $member_id = $this->input->post('member_id', true);
        
        $broken_sched = $this->input->post('broken_sched', true);
        $comment = $this->input->post('comment', true);

        $apply_broken_sched = array(
            'time_from'     => $broken_sched,
            'remarks'       => 'Broken Schedule',
            'comment'       => $comment,
            'date_updated'  => date('Y-m-d H:i:s'),
        );

        $result = $this->attendance_record_model->save_broken_sched($apply_broken_sched, $selected_sched_id);
        if ($result == TRUE) {
            $member = $this->attendance_record_model->get_row('scholarship_member', array('member_id' => $member_id));
            $logs = array(
                'user_id'       => $this->session->userdata('adminIn')['user_id'],
                'user_type_id'  => $this->session->userdata('adminIn')['user_type_id'],
                'transaction'   => 'Apply broken schedule to '.$member['scholarship_no'],
                'remarks'       => 'Broken Schedule',
                'email_use'     => $this->session->userdata('adminIn')['email_add'],
            );
            $this->insert_activity_logs($logs);
            $success = 'Broken schedule successfully applied.';
        } else {
            $error = 'Failed to apply the broken schedule.';
        }

        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }

    public function view_letter()
    {
        $error = '';
        $success = '';

        $member_id = $this->input->post('member_id', true);

        $check_letter = $this->attendance_record_model->check_uploaded_letter($member_id);
        if ($check_letter->num_rows() > 0) {
            $letter = $check_letter->row_array();

            $attachment = $letter['attachment'];
            $uploaded_id = $letter['uploaded_id'];
        } else {
            $error = 'No uploaded letter found.';
        }

        $output = array(
            'error' => $error,
            'attachment' => $attachment,
            'uploaded_id' => $uploaded_id,
            'member_id' => $member_id,
        );
        echo json_encode($output);
    }

    private function download_attachment($folder)
    {
        $attachment = $_GET['file'];
        $filename = $attachment;
        $file_path = 'assets/uploaded_attachment/' . $folder . '/' . $filename;
        $this->load->helper('download');
        force_download($file_path, NULL);
    }

    public function download()
    {
        $this->download_attachment('excuse_letter');
    }

    public function verify_letter()
    {
        $error = '';
        $success = '';
        $letter_verification = $this->input->post('letter_verification', true);
        $member_id = $this->input->post('member_id', true);
        $uploaded_id = $this->input->post('uploaded_id', true);

        $member = $this->attendance_record_model->get_row('scholarship_member', array('member_id' => $member_id));

        $verify_letter = array(
            'remarks' => $letter_verification,
        );

        $result = $this->attendance_record_model->verify_letter($uploaded_id, $verify_letter);
        if ($result == TRUE) {

            $schedules = $this->attendance_record_model->get_time_in($member_id);
            $late_rules = $this->attendance_record_model->getActiveRules();
            $no_days = isset($late_rules->no_days) ? $late_rules->no_days : 0;
            foreach ($schedules as $list) {
                $this->attendance_record_model->get_attendance_update($member_id, $list['schedule_date'], 'Time-In', $no_days);
            }

            if($letter_verification == 'Valid') {
                $subject = 'Letter Verification [Valid]';
                $template = 'email_template/approved_letter';
            } else {
                $subject = 'Letter Verification [Invalid]';
                $template = 'email_template/invalid_letter';
            }

            $mail_data = [
                'name_to'   => $member['student_first_name'],
                'comment'   => $this->input->post('comment', true),
            ];

            $this->send_email_html([
                'mail_to'       => $member['email_address'],
                'cc'            => [],
                'subject'       => $subject,
                'template_path' => $template,
                'mail_data'     => $mail_data,
            ]);
            $success = 'Letter verification successfully submitted.'; 
        } else {
            $error = 'Failed to verify the letter.';
        }

        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }

    //====================No Time In/Out Request=========================

    public function no_in_out_request()
    {
        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/portal');
        $data['active_page'] = 'attendance_page';
        $data['card_title'] = 'No Time In/Out Request';
        $data['icon'] = 'bi bi-calendar-week-fill';
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
        $this->load->view('admin_portal/no_in_out_request', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function requestCount()
    {
        $request = $this->attendance_record_model->get_request_count();

        $output = array(
            'request_count' => $request->num_rows(),
        );
        echo json_encode($output);
    }

    public function get_explanation_letter()
    {
        $letter = $this->attendance_record_model->get_explanation_letter();
        $data = array();
        $no = $_POST['start'];
        foreach ($letter as $list) {
            $no++;
            $row = array();

            $img = base_url()."assets/images/avatar-default-0.png";
            if(!empty($list->personal_photo)){
				if(file_exists('./assets/uploaded_attachment/personal_photo/'.$list->personal_photo)){
					$img = base_url()."assets/uploaded_attachment/personal_photo/".$list->personal_photo;
                }
            }
            $row[] = '<img class="img-profile" src="' . $img . '" alt="Profile-Picture">';
            $row[] = ucwords($list->student_name);

            $color_mapping = [
                'No Time-In' => 'bg-primary',
                'No Time-Out' => 'bg-danger',
            ];
            $badge_color = isset($color_mapping[$list->remarks]) ? $color_mapping[$list->remarks] : 'bg-primary';
            $row[] = '<div class="badge ' . $badge_color . ' px-3 mb-1">' . $list->remarks . '</div>' . 
                     '<div style="font-size:11px; font-weight:500; color:red;">Attendance Date: '.date('F j, Y', strtotime($list->attendance_date)).'</div>';
            $row[] = date('D M j, Y h:i A', strtotime($list->date_created));

            $status_mapping = [
                'For Approval' => 'bg-warning',
                'Valid Letter' => 'bg-success',
                'Invalid Letter' => 'bg-danger',
            ];
            $status_color = isset($status_mapping[$list->request_status]) ? $status_mapping[$list->request_status] : 'bg-warning';
            $row[] = '<div class="badge ' . $status_color . ' px-3 mb-1">' . $list->request_status . '</div>' .
                     '<div class="open_link" style="font-size:11px;" id="download_explanation" data-id="'.$list->letter_id.'"><i class="bi bi-download me-1"></i>Download Attachment</div>';
            $row[] = date('h:i A', strtotime($list->time_in_out));

            $row[] = '<button class="btn btn-outline-info btn-sm approval_modal" data-id="'.$list->letter_id.'"><i class="bi bi-subtract me-1"></i>Approval</button>';

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->attendance_record_model->count_all_request(),
            "recordsFiltered" => $this->attendance_record_model->count_filtered_request(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

    public function download_explanation_letter()
    {
        $this->load->helper('url');
        $this->load->helper('download');

        $letter_id = $this->input->post('letter_id', true);

        $fileinfo = $this->attendance_record_model->download_explanation_letter($letter_id); 
        if (!$fileinfo) {
            $this->output
                ->set_status_header(404)
                ->set_output(json_encode(array('error' => 'File not found')));
            return;
        }

        $filename = $fileinfo['attachment'];
        $file_path = FCPATH . 'assets/uploaded_attachment/excuse_letter/' . $filename;

        if (file_exists($file_path)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename=' . $filename);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));
            ob_clean();
            flush();
            readfile($file_path);
            exit;
        } else {
            $this->output
                ->set_status_header(404)
                ->set_output(json_encode(array('error' => 'File not found')));
        }
    }

    //====================End No Time In/Out Request=========================
}
