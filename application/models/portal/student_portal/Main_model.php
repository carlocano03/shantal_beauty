<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2022,
 *
 */
class Main_model extends MY_Model
{
    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function getAvailableSched()
    {
        $this->db->where('status', 0);
        $query = $this->db->get('church_schedule');
        return $query;
    }

    function check_schedule($member_id)
    {
        $start_dt = date('Y-m-01');
        $end_date_obj = date('Y-m-t');

        $this->db->where('member_id', $member_id);
        $this->db->where('DATE(date_from) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(date_from) <=', $end_date_obj);
        $query = $this->db->get('scholar_schedule');
        return $query;
    }

    function check_existing_schedule($start_dt, $end_date_obj)
    {
        $this->db->where('member_id', $this->session->userdata('scholarIn')['member_id']);
        $this->db->where('DATE(date_from) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(date_from) <=', $end_date_obj);
        $query = $this->db->get('scholar_schedule');
        return $query;
    }

    function insert_scholar_schedule($insert_sched)
    {
        $insert = $this->db->insert('scholar_schedule', $insert_sched);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return '';
        } 
    }

    function insert_scholar_selected_schedule($scholar_sched_id, $member_id, $start_dt, $end_date_obj, $time_in, $time_out, $day_week, $sched_id)
    {
        $day_week_num = $this->getDayOfWeekNumber($day_week);

        if ($day_week_num !== false) {
            // Get all dates of the specified day of the week between the start and end date
            $dates = $this->getDatesInRange($start_dt, $end_date_obj, $day_week_num);

            // Insert data for each date
            foreach ($dates as $date) {
                $this->saveSchedule($scholar_sched_id, $member_id, $date, $time_in, $time_out, $day_week, $sched_id);
            }
        }
    }

    function saveSchedule($scholar_sched_id, $member_id, $date, $time_in, $time_out, $day_week, $sched_id) {
        $data = [
            'scholar_sched_id'  => $scholar_sched_id,
            'member_id'         => $member_id,
            'sched_id'          => $sched_id,
            'schedule_date'     => $date,
            'time_from'         => $time_in,
            'time_to'           => $time_out,
            'day_name'          => $day_week,
            'date_created'      => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('scholar_selected_schedule', $data);
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

    private function getDatesInRange($start_dt, $end_date_obj, $day_week_num) {
        $dates = [];
        $start_date = strtotime($start_dt);
        $end_date = strtotime($end_date_obj);

        while ($start_date <= $end_date) {
            if (date('N', $start_date) == $day_week_num) {
                $dates[] = date('Y-m-d', $start_date);
            }
            $start_date = strtotime('+1 day', $start_date);
        }
        return $dates;
    }
    
    function check_selected_sched($sched_id)
    {
        $start_dt = date('Y-m-01');
        $end_date_obj = date('Y-m-t');

        $this->db->where('member_id', $this->session->userdata('scholarIn')['member_id']);
        $this->db->where('sched_id', $sched_id);
        $this->db->where('DATE(date_from) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(date_from) <=', $end_date_obj);
        $query = $this->db->get('scholar_schedule');
        return $query;
    }

}