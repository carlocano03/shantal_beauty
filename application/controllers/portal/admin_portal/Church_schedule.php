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

class Church_schedule extends MY_Controller
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
        $this->load->model('portal/admin_portal/church_schedule_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('adminIn', 'login');
    } //End __construct

    public function index()
    {
        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/portal');
        $data['active_page'] = 'church_settings_page';
        $data['card_title'] = 'Church Schedule Settings';
        $data['icon'] = 'bi bi-calendar-week-fill';
        $data['header_contents'] = array(
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );
        $this->load->view('admin_portal/partial/_header', $data);
        $this->load->view('admin_portal/church_schedule', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }
    
    public function add_new_schedule()
    {
        $success = '';
        $error = '';
        $action = $this->input->post('action', true);

        $sched_name = $this->input->post('sched_name', true);
        $day_week = $this->input->post('day_week', true);
        $time_in = $this->input->post('time_in', true);
        $time_out = $this->input->post('time_out', true);

        if ($action == 'Update') {
            $sched_id = $this->input->post('sched_id', true);

            $update_sched = array(
                'schedule_name' => $sched_name,
                'day_week'      => $day_week,
                'time_in'       => $time_in,
                'time_out'      => $time_out,
            );
            $result = $this->church_schedule_model->update_schedule($update_sched, $sched_id);
            if ($result == TRUE) {
                $success = 'Church schedule successfully updated.';
            } else {
                $error = 'Failed to update the schedule.';
            }
        } else {
            //Insert
            $check_sched = $this->church_schedule_model->check_existing_sched($day_week, $time_in, $time_out);
            if ($check_sched->num_rows() > 0) {
                $error = 'Church schedule already exist.';
            } else {
                $insert_sched = array(
                    'schedule_name' => $sched_name,
                    'day_week'      => $day_week,
                    'time_in'       => $time_in,
                    'time_out'      => $time_out,
                    'date_created'  => date('Y-m-d H:i:s'),
                );
                $result = $this->church_schedule_model->add_new_schedule($insert_sched);
                if ($result == TRUE) {
                    $success = 'Church schedule successfully added.';
                } else {
                    $error = 'Failed to add new schedule.';
                }
            }
        }

        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }

    public function get_church_schedule()
    {
        $output = '';
        $sched = $this->church_schedule_model->get_church_schedule();

        if ($sched->num_rows() > 0) {
            foreach($sched->result() as $list) {
                if ($list->status == 0) {
                    $checked = 'checked';
                    $opacity = '';
                } else {
                    $checked = '';
                    $opacity = 'opacity: 0.5;';
                }
                $output .= '
                    <div class="col-md-6 mb-3"  style="'.$opacity.'">
                        <div class="overview-card" id="open_action"
                            data-id="'.$list->sched_id.'"
                            data-name="'.$list->schedule_name.'"
                            data-day="'.$list->day_week.'"
                            data-in="'.$list->time_in.'"
                            data-out="'.$list->time_out.'"
                            data-status="'.$list->status.'"
                        >
                            <div class="d-flex align-items-center gap-3 justify-content-between">
                                <div class="dashboard__img-container">
                                    <img class="dashboard__img"
                                        src="'.base_url('assets/images/dashboard/timetable.png').'"
                                        alt="Scholars" />
                                </div>
                                <div class="flex flex-column text-end">
                                    <div style="margin-top:-20px;">
                                        <label class="switch">
                                            <input type="checkbox" class="schedule_activation" '.$checked.' data-id="'.$list->sched_id.'">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="custom-card__title">'.ucwords($list->schedule_name).'</div>
                                    <div class="custom-card__sub-text">
                                        <i class="bi bi-calendar-week me-2"></i>'.$list->day_week.'
                                    </div>
                                    <div class="custom-card__sub-text">
                                        <i class="bi bi-clock me-2"></i>'.date('h:i A', strtotime($list->time_in)). ' - '.date('h:i A', strtotime($list->time_out)).'
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }
        } else {
            $output .= '<div class="col-12 alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>No schedule found.</div>';
        }


        //Chart Data
        $schedData = $this->church_schedule_model->fetch_data_chart();
        $labels = array();
        $datasets = array(
            'label' => 'Schedules',
            'data' => array(),
            'backgroundColor' => array("rgb(54, 162, 235)", "rgb(255, 99, 132)")
        );

        if($schedData->num_rows() > 0) {
            foreach ($schedData->result() as $row) {
                $labels[] = $row->schedule_name;
                $datasets['data'][] = $row->sched_count;
            }
        }

        $data = array(
            'labels' => $labels,
            'datasets' => array($datasets)
        );

        $output = array(
            'sched_list' => $output,
            'chart' => $data,
            'count' => $schedData->num_rows(),
        );
        echo json_encode($output);
    }

    public function schedule_activation()
    {
        $message = '';
        $action = $this->input->post('action', true);
        $sched_id = $this->input->post('sched_id', true);

        if ($action == 'Activate') {
            $update_sched = array(
                'status' => 0,//Active
            ); 
        } elseif ($action == 'Deactivate') {
            $update_sched = array(
                'status' => 1,//Deactivate
            ); 
        } else {
            $update_sched = array(
                'status' => 2,//Deleted
            ); 
        }
        $result = $this->church_schedule_model->update_schedule($update_sched, $sched_id);
        if ($result == TRUE) {
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output['message'] = $message;
        echo json_encode($output);
    }

}