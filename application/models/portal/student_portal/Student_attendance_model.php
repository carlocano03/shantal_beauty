<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2022,
 *
 */
class Student_attendance_model extends MY_Model
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

    function check_schedule()
    {
        $start_dt = date('Y-m-01');
        $end_date_obj = date('Y-m-t');

        $this->db->where('member_id', $this->session->userdata('scholarIn')['member_id']);
        $this->db->where('DATE(date_from) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(date_from) <=', $end_date_obj);
        $query = $this->db->get('scholar_schedule');
        return $query;
    }

    function get_student_schedule_list()
    {
        $start_dt = date('Y-m-01');
        $end_date_obj = date('Y-m-t');

        $this->db->where('member_id', $this->session->userdata('scholarIn')['member_id']);
        $this->db->where('DATE(schedule_date) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(schedule_date) <=', $end_date_obj);
        $query = $this->db->get('scholar_selected_schedule');
        return $query;
    }

    function get_schedule_list($sched_id)
    {
        $this->db->where('sched_id !=', $sched_id);
        $this->db->where('status', 0);
        $query = $this->db->get('church_schedule');
        return $query;
    }

    function update_schedule($update_sched, $selected_sched_id)
    {
        $this->db->where('selected_schedule_id ', $selected_sched_id);
        $update = $this->db->update('scholar_selected_schedule', $update_sched);
        return $update?TRUE:FALSE;
    }

    function get_attendance_record($member_id, $schedule_date)
    {
        $this->db->where('member_id', $member_id);
        $this->db->where('attendance_date', $schedule_date);
        $query = $this->db->get('attendance_record');
        return $query;
    }

    function save_excuse_letter($upload_letter)
    {
        $insert = $this->db->insert('excuse_letter', $upload_letter);
        return $insert?TRUE:FALSE;
    }

    function get_excuse_letter($member_id, $schedule_date)
    {
        $this->db->where('member_id', $member_id);
        $this->db->where('attendance_date', $schedule_date);
        $query = $this->db->get('excuse_letter');
        return $query;
    }

}