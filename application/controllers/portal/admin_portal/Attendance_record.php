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
            
            //Check the student schedule
            $schedule = $this->attendance_record_model->check_student_schedule($list->member_id);
            $schedule_row_count = $schedule->num_rows();
            $schedule_row = $schedule->row_array();

            if($schedule_row_count > 0) {
                $action = '
                    <div class="btn-group">
                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item link-cursor text-primary manage_attendance" data-id="'.$member_id.'"><i class="bi bi-view-list me-2"></i>Manage Attendance</a></li>
                            <li><a class="dropdown-item link-cursor text-danger view_schedule" data-id="'.$list->member_id.'"><i class="bi bi-calendar-week-fill me-2"></i>View Schedule</a></li>
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
                    <div class="btn-group">
                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item link-cursor text-primary manage_attendance" data-id="'.$member_id.'"><i class="bi bi-view-list me-2"></i>Manage Attendance</a></li>
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
                                <th style="background: #222f3e; color: #fff;" rowspan="3">ACTION</th>
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
            $schedule = $this->attendance_record_model->get_student_schedule_list($member_id, $start_dt, $end_date_obj);
            foreach($schedule->result_array() as $list) {

                $output .= '
                             <tr>
                                <td class="fw-bold">'.strtoupper(date('M-d', strtotime($list['schedule_date']))).'</td>
                                <td class="fw-bold">'.strtoupper(date('D', strtotime($list['day_name']))).'</td>
                                <td></td>
                                <td class="fw-bold">'.date('h:i A', strtotime($list['time_from'])).'</td>
                                <td></td>
                                <td class="fw-bold">'.date('h:i A', strtotime($list['time_to'])).'</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                ';
            }

            $output .= '</tbody">';
            $output .= '</table">';
        } else {
            $output .= '<div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>No schedule selected.</div>';
        }
        $data = array(
            'attendance' => $output,
            'date_sched' => $date_sched,
        );
        echo json_encode($data);
    }

}