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

class Student_attendance extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('language');
        $this->lang->load('common','english');
        $this->load->model('portal/student_portal/student_attendance_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('scholarIn', 'login');
    } //End __construct

    public function index()
    {
        $data['home_url'] = base_url('student/portal');
        $data['active_page'] = 'attendance_page';
        $data['card_title'] = 'Attendance Record';
        $data['icon'] = 'bi bi-calendar-week-fill';
        $this->load->view('student_portal/partial/_header', $data);
        $this->load->view('student_portal/attendance_record', $data);
        $this->load->view('student_portal/partial/_footer', $data);
    }

    public function getAttendanceRecord()
    {
        $output = '';
        $date_sched = '';
        $month = $this->input->post('month', true);
        $check_sched = $this->student_attendance_model->check_schedule($month);
        if ($check_sched->num_rows() > 0) {
            $date_sched = 'Church Schedule for the month of '.date('F Y');
            $output .= '<table class="tbl_schedule">';
            $output .= '
                            <tr>
                                <th style="background: #222f3e; color: #fff;" rowspan="3">DATE</th>
                                <th style="background: #222f3e; color: #fff;" rowspan="3">DAY</th>
                                <th style="background: #222f3e; color: #fff;" colspan="4">REGULAR TIME</th>
                                <th style="background: #222f3e; color: #fff;" colspan="2">TOTAL TIME</th>
                                <th style="background: #222f3e; color: #fff;" colspan="2">TARDINESS</th>
                                <th style="background: #222f3e; color: #fff;" rowspan="3">PRESENT</th>
                                <th style="background: #222f3e; color: #fff;" rowspan="3">ABSENT</th>
                                <th style="background: #222f3e; color: #fff;" rowspan="3">LATE</th>
                                <th style="background: #222f3e; color: #fff; width:13%;" rowspan="3">ACTION</th>
                            </tr>
                            <tr>
                                <th style="font-size:9px; background: #353b48; color: #fff;" colspan="2">Arrival</th>
                                <th style="font-size:9px; background: #353b48; color: #fff;" colspan="2">Departure</th>
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

            $output .= '<tbody">';

            $schedule = $this->student_attendance_model->get_student_schedule_list($month);
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
                $schedule_date = strtotime($list['schedule_date']);
                $current_date = strtotime(date('Y-m-d'));
                $can_change = $current_date < $schedule_date;
                
                if ($can_change) {
                    $action = '<button class="btn btn-outline-primary btn-xs change_schedule"
                                data-id="'.$list['selected_schedule_id'].'"
                                data-sched_date="'.date('F j, Y', strtotime($list['schedule_date'])).'"
                                data-sched_id="'.$list['sched_id'].'"
                               ><i class="bi bi-calendar2-check-fill me-1"></i>Change Schedule</button>';
                } else {
                    $action = '<span class="badge bg-info px-2">Ongoing Schedule</span>';
                }


                //Attendance Data
                $attendance = $this->student_attendance_model->get_attendance_record($list['member_id'], $list['schedule_date']);
                $attendance_row = $attendance->row_array();

                $timeIn = $this->student_attendance_model->get_attendance($list['member_id'], $list['schedule_date'], 'Time-In');
                $timeOut = $this->student_attendance_model->get_attendance($list['member_id'], $list['schedule_date'], 'Time-Out');

                $time_in = '';
                $time_out = '';
                $present = '';
                $absent = '';
                $late = '';

                //Uploaded excuse letter
                $letter = $this->student_attendance_model->get_excuse_letter($list['member_id'], $list['schedule_date']);
                $letter_row = $letter->row_array();
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

                            if ($letter->num_rows() > 0) {
                                if (is_array($letter_row) && !empty($letter_row)) {
                                    if ($letter_row['remarks'] == 'For Validation') {
                                        $action = '<span class="badge bg-warning"><i class="bi bi-check2-square me-1"></i>With Uploaded Letter</span>';
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
                                $action = '<button class="btn btn-danger btn-xs upload_excuse"
                                                data-action="Late"
                                                data-date="'.$list['schedule_date'].'"
                                                data-id="'.$list['member_id'].'"
                                            ><i class="bi bi-upload me-1"></i>Upload Letter</button>';
                            }
                            
                        } else {
                            $late = '';
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
                    }
                } else {
                    $dateToday = date('Y-m-d');
                    if ($dateToday > $list['schedule_date']) {
                        $time_in = '<span class="font-weight-bold text-danger">--:--:--</span>';
                        $time_out = '<span class="font-weight-bold text-danger">--:--:--</span>';
                        $absent = '<i class="bi bi-check-circle-fill text-danger"></i>';
                        $late_hours = '--';
                        $late_minutes = '--';
                        $late = '';
                        $total_hours = '--';
                        $total_minutes = '--';
                        $total_absent++;

                        if ($letter->num_rows() > 0) {
                            if (is_array($letter_row) && !empty($letter_row)) {
                                if ($letter_row['remarks'] == 'For Validation') {
                                    $action = '<span class="badge bg-warning"><i class="bi bi-check2-square me-1"></i>With Uploaded Letter</span>';
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
                            $action = '<button class="btn btn-danger btn-xs upload_excuse"
                                            data-action="Absent"
                                            data-date="'.$list['schedule_date'].'"
                                            data-id="'.$list['member_id'].'"
                                        ><i class="bi bi-upload me-1"></i>Upload Letter</button>';
                        }
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

            $output .= '
                        <tfoot>
                            <tr>
                                <td colspan="6" style="background: #576574; color: #fff;"></td>
                                <td colspan="2" style="background: #353b48; color: #fff; font-weight:bold;"><i class="bi bi-clock me-1"></i>'.$total_work_time.'h '.$remaining_minutes.'m</td>
                                <td colspan="2" style="background: #353b48; color: #fff; font-weight:bold;"><i class="bi bi-clock me-1"></i>'.$tardiness_time.'h '.$remaining_late_minutes.'m</td>
                                <td style="background: #222f3e; color: #fff; font-weight:bold;">'.$total_present.'</td>
                                <td style="background: #222f3e; color: #fff; font-weight:bold;">'.$total_absent.'</td>
                                <td style="background: #222f3e; color: #fff; font-weight:bold;">'.$total_late.'</td>
                                <td colspan="3" style="background: #576574; color: #fff;"></td>
                            </tr>
                        </tfoot>
            ';
            $output .= '</table">';
        } else {
            $output .= '<div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>Schedule not selected. Please click <a href="#scheduleModal" data-bs-toggle="modal">here</a> to choose your preferred schedule.</div>';
        }

        $data = array(
            'attendance' => $output,
            'date_sched' => $date_sched,
        );
        echo json_encode($data);
    }

    public function get_schedule_list()
    {
        $output = '';
        $error = '';
        $sched_id = $this->input->post('schedule_id', true);
        $sched = $this->student_attendance_model->get_schedule_list($sched_id);
        $no = 0;
        if ($sched->num_rows() > 0) {
            foreach($sched->result() as $list) {
                $no++;

                $output .= '
                    <div class="upcoming-sched__date-container-'.$no.' mb-3 " style="cursor:pointer;" id="update_schedule" data-id="'.$list->sched_id.'">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h1 class="upcoming-sched__weekday mb-0">'.$list->day_week.'</h1>
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
            'schedule_list' => $output,
        );
        echo json_encode($data);
    }

    public function update_schedule()
    {
        $success = '';
        $error = '';
        $available_sched_id = $this->input->post('available_sched_id', true); //Sched_id
        $selected_sched_id = $this->input->post('selected_sched_id', true);

        $schedule = $this->student_attendance_model->get_row('church_schedule', array('sched_id' => $available_sched_id));
        $existing_sched = $this->student_attendance_model->get_row('scholar_selected_schedule', array('selected_schedule_id' => $selected_sched_id));

        $day_week_num = $this->getDayOfWeekNumber($schedule['day_week']);
        $existing_date = $existing_sched['schedule_date'];

        if ($day_week_num !== false) {
            // Calculate the next occurrence of the specified day of the week
            $next_date = $this->getNextDayOfWeekDate($day_week_num);

            //Update
            $update_sched = array(
                'sched_id'      => $available_sched_id,
                'schedule_date' => $next_date,
                'time_from'     => $schedule['time_in'],
                'time_to'       => $schedule['time_out'],
                'day_name'      => $schedule['day_week'],
            );
            $result = $this->student_attendance_model->update_schedule($update_sched, $selected_sched_id);
            if ($result == TRUE) {
                $success = 'Schedule successfully changed.';
            } else {
                $error = 'Failed to change the schedule.';
            }
        }
        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }

    private function getDayOfWeekNumber($day_week) {
        $days = [
            'Monday' => 1,
            'Tuesday' => 2,
            'Wednesday' => 3,
            'Thursday' => 4,
            'Friday' => 5,
            'Saturday' => 6,
            'Sunday' => 7
        ];
        return isset($days[$day_week]) ? $days[$day_week] : false;
    }

    private function getNextDayOfWeekDate($dayOfWeek) {
        // Get the current day of the week
        $currentDayOfWeek = date('N'); // 1 (Monday) through 7 (Sunday)
    
        // Calculate the offset to the next occurrence of $dayOfWeek
        $offset = ($dayOfWeek - $currentDayOfWeek + 7) % 7;
    
        // Calculate the next date
        $nextDate = strtotime("+$offset days");
    
        // Format the next date as desired (e.g., YYYY-MM-DD)
        $formattedDate = date('Y-m-d', $nextDate);
    
        return $formattedDate;
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

        $action = $this->input->post('action', true);
        $attendance_date = $this->input->post('attendance_date', true);
        $member_id = $this->input->post('member_id', true);
        $attachment = $this->upload_attachment();

        if ($action == 'Late') {
            $letter_for = 'Late';
        } else {
            $letter_for = 'Absent';
        }
        $upload_letter = array(
            'member_id'         => $member_id,
            'attendance_date'   => $attendance_date,
            'attachment'        => $attachment,
            'remarks'           => 'For Validation',
            'date_created'      => date('Y-m-d H:i:s'),
            'letter_for'        => $letter_for,
        );

        $result = $this->student_attendance_model->save_excuse_letter($upload_letter);
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