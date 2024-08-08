<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class Church_schedule_model extends MY_Model
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

    function check_existing_sched($day_week, $time_in, $time_out)
    {
        $this->db->where('day_week', $day_week);
        $this->db->where('time_in', $time_in);
        $this->db->where('time_out', $time_out);
        $this->db->where('status !=', 2);
        $query = $this->db->get('church_schedule');
        return $query;
    }
    
    function add_new_schedule($insert_sched)
    {
        $insert = $this->db->insert('church_schedule', $insert_sched);
        return $insert?TRUE:FALSE;
    }

    function update_schedule($update_sched, $sched_id)
    {
        $this->db->where('sched_id', $sched_id);
        $update = $this->db->update('church_schedule', $update_sched);
        return $update?TRUE:FALSE;
    }

    function get_church_schedule()
    {
        $this->db->where('status !=', 2);
        $query = $this->db->get('church_schedule');
        return $query;
    }

    function fetch_data_chart()
    {
        $start_dt = date('Y-m-01');
        $end_date_obj = date('Y-m-t');

        $this->db->select('schedule_name, COUNT(*) as sched_count');
        $this->db->from('scholar_schedule');
        $this->db->where('status', 0);
        // $this->db->where('DATE(date_from) >=', $start_dt);  // Adjust the year as needed
        // $this->db->where('DATE(date_from) <=', $end_date_obj);
        $this->db->group_by('sched_id');
        $query = $this->db->get();
        return $query;
    }
}