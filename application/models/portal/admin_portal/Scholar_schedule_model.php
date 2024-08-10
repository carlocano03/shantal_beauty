<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class Scholar_schedule_model extends MY_Model
{
    var $scholar = 'scholarship_member';
    var $scholar_order = array('SM.scholarship_no', 'SM.student_last_name', 'SM.student_first_name', 'SM.student_middle_name');
    var $scholar_search = array('SM.scholarship_no', 'SM.student_last_name', 'SM.student_first_name', 'SM.student_middle_name'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order = array('SM.student_last_name' => 'ASC'); // default order

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

    public function get_student_with_schedule()
    {
        $this->_get_student_with_schedule_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_student_with_schedule_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $start_dt = date('Y-m-01');
        $end_date_obj = date('Y-m-t');

        $this->db->select('SM.*, CS.schedule_name, CS.day_week, CS.time_in, CS.time_out');
        $this->db->from($this->scholar.' SM');
        $this->db->join('scholar_schedule SS', 'SM.member_id = SS.member_id', 'left');
        $this->db->join('church_schedule CS', 'SS.sched_id = CS.sched_id', 'left');
        $this->db->where('DATE(SS.date_from) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(SS.date_from) <=', $end_date_obj);
        $this->db->where('SM.status', 0);
        return $this->db->count_all_results();
    }

    private function _get_student_with_schedule_query()
    {
        $start_dt = date('Y-m-01');
        $end_date_obj = date('Y-m-t');

        $this->db->select('SM.*, CS.schedule_name, CS.day_week, CS.time_in, CS.time_out');
        $this->db->from($this->scholar.' SM');
        $this->db->join('scholar_schedule SS', 'SM.member_id = SS.member_id', 'left');
        $this->db->join('church_schedule CS', 'SS.sched_id = CS.sched_id', 'left');
        $this->db->where('DATE(SS.date_from) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(SS.date_from) <=', $end_date_obj);
        $this->db->where('SM.status', 0);

        $i = 0;
        foreach ($this->scholar_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->scholar_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->scholar_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    //Without schedule
    public function get_student_without_schedule()
    {
        $this->_get_student_without_schedule_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_without()
    {
        $this->_get_student_without_schedule_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_without()
    {
        $start_dt = date('Y-m-01');
        $end_date_obj = date('Y-m-t');

        $this->db->select('SM.*, CS.schedule_name, CS.day_week, CS.time_in, CS.time_out');
        $this->db->from($this->scholar.' SM');
        $this->db->join('scholar_schedule SS', 'SM.member_id = SS.member_id AND DATE(SS.date_from) >= \'' . $start_dt . '\' AND DATE(SS.date_from) <= \'' . $end_date_obj . '\'', 'left');
        $this->db->join('church_schedule CS', 'SS.sched_id = CS.sched_id', 'left');
        $this->db->where('SM.status', 0);
        $this->db->where('SS.sched_id IS NULL');
        return $this->db->count_all_results();
    }

    private function _get_student_without_schedule_query()
    {
        $start_dt = date('Y-m-01');
        $end_date_obj = date('Y-m-t');

        $this->db->select('SM.*, CS.schedule_name, CS.day_week, CS.time_in, CS.time_out');
        $this->db->from($this->scholar.' SM');
        $this->db->join('scholar_schedule SS', 'SM.member_id = SS.member_id AND DATE(SS.date_from) >= \'' . $start_dt . '\' AND DATE(SS.date_from) <= \'' . $end_date_obj . '\'', 'left');
        $this->db->join('church_schedule CS', 'SS.sched_id = CS.sched_id', 'left');
        $this->db->where('SM.status', 0);
        $this->db->where('SS.sched_id IS NULL');

        $i = 0;
        foreach ($this->scholar_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->scholar_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->scholar_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_count_with_schedule()
    {
        $start_dt = date('Y-m-01');
        $end_date_obj = date('Y-m-t');

        $this->db->select('SM.*, CS.schedule_name, CS.day_week, CS.time_in, CS.time_out');
        $this->db->from($this->scholar.' SM');
        $this->db->join('scholar_schedule SS', 'SM.member_id = SS.member_id', 'left');
        $this->db->join('church_schedule CS', 'SS.sched_id = CS.sched_id', 'left');
        $this->db->where('DATE(SS.date_from) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(SS.date_from) <=', $end_date_obj);
        $this->db->where('SM.status', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_count_without_schedule()
    {
        $start_dt = date('Y-m-01');
        $end_date_obj = date('Y-m-t');

        $this->db->select('SM.*, CS.schedule_name, CS.day_week, CS.time_in, CS.time_out');
        $this->db->from($this->scholar.' SM');
        $this->db->join('scholar_schedule SS', 'SM.member_id = SS.member_id AND DATE(SS.date_from) >= \'' . $start_dt . '\' AND DATE(SS.date_from) <= \'' . $end_date_obj . '\'', 'left');
        $this->db->join('church_schedule CS', 'SS.sched_id = CS.sched_id', 'left');
        $this->db->where('SM.status', 0);
        $this->db->where('SS.sched_id IS NULL');
        $query = $this->db->get();
        return $this->db->count_all_results();
    }

    function biometric_logs_count()
    {
        $start_dt = date('Y-m-01');
        $end_date_obj = date('Y-m-t');

        $this->db->select('AR.*');
        $this->db->select("CONCAT(SM.student_last_name, ', ', SM.student_first_name) as scholar");
        $this->db->from('attendance_record AR');
        $this->db->join('scholarship_member SM', 'AR.member_id = SM.member_id', 'left');
        $this->db->where('DATE(AR.attendance_date) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(AR.attendance_date) <=', $end_date_obj);
        $this->db->where('AR.status', 0);
        return $this->db->count_all_results();
    }

    function biometric_logs($limit, $start)
    {
        $start_dt = date('Y-m-01');
        $end_date_obj = date('Y-m-t');

        $this->db->select('AR.*, SM.personal_photo');
        $this->db->select("CONCAT(SM.student_last_name, ', ', SM.student_first_name) as scholar");
        $this->db->from('attendance_record AR');
        $this->db->join('scholarship_member SM', 'AR.member_id = SM.member_id', 'left');
        $this->db->where('DATE(AR.attendance_date) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(AR.attendance_date) <=', $end_date_obj);
        $this->db->where('AR.status', 0);
        $this->db->order_by('AR.attendance_date', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query;
    }
}