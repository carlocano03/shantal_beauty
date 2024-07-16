<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class Attendance_record_model extends MY_Model
{
    var $scholar = 'scholarship_member';
    var $scholar_order = array('scholarship_no', 'student_last_name', 'student_first_name', 'student_middle_name', 'year_level', 'course');
    var $scholar_search = array('scholarship_no', 'student_last_name', 'student_first_name', 'student_middle_name', 'year_level', 'course'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order = array('member_id' => 'ASC'); // default order

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

    public function get_student_list()
    {
        $this->_get_student_list_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_student_list_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->scholar);
        $this->db->where('status', 0);
        return $this->db->count_all_results();
    }

    private function _get_student_list_query()
    {
        $this->db->from($this->scholar);
        $this->db->where('status', 0);
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

    function check_student_schedule($member_id)
    {
        $start_dt = date('Y-m-01');
        $end_date_obj = date('Y-m-t');

        $this->db->where('member_id', $member_id);
        $this->db->where('DATE(date_from) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(date_from) <=', $end_date_obj);
        $query = $this->db->get('scholar_schedule');
        return $query;
    }

    function check_attendance_schedule($member_id, $month)
    {
        $month = date('Y-m', strtotime($month));
        $this->db->where('member_id', $member_id);
        $this->db->where("DATE_FORMAT(date_from, '%Y-%m') = '$month'");
        $this->db->where('status', 0);
        $query = $this->db->get('scholar_schedule');
        return $query->num_rows() > 0;
    }
    
    function view_scholar($member_id)
    {
        $this->db->where('member_id', $member_id);
        $this->db->where('member_status', 'Member');
        $query = $this->db->get('scholarship_member');
        return $query->row_array();
    }

    function view_attendance_prev($member_id)
    {
        $this->db->select('member_id');
        $this->db->from('scholarship_member');
        $this->db->where('member_id <', $member_id);
        $this->db->where('member_status', 'Member');
        $this->db->order_by('member_id', 'ASC');
        $query = $this->db->get();
        return $query->row_array();
    }

    function view_attendance_next($member_id)
    {
        $this->db->select('member_id');
        $this->db->from('scholarship_member');
        $this->db->where('member_id >', $member_id);
        $this->db->where('member_status', 'Member');
        $this->db->order_by('member_id', 'ASC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    function check_schedule($member_id, $start_dt, $end_date_obj)
    {
        $this->db->where('member_id', $member_id);
        $this->db->where('DATE(date_from) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(date_from) <=', $end_date_obj);
        $query = $this->db->get('scholar_schedule');
        return $query;
    }

    function get_student_schedule_list($member_id, $start_dt, $end_date_obj)
    {
        $this->db->where('member_id', $member_id);
        $this->db->where('DATE(schedule_date) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(schedule_date) <=', $end_date_obj);
        $query = $this->db->get('scholar_selected_schedule');
        return $query;
    }

    function get_attendance_record($member_id, $schedule_date)
    {
        $this->db->where('member_id', $member_id);
        $this->db->where('attendance_date', $schedule_date);
        $query = $this->db->get('attendance_record');
        return $query;
    }

    function get_attendance($member_id, $schedule_date, $remarks)
    {
        $this->db->where('member_id', $member_id);
        $this->db->where('attendance_date', $schedule_date);
        $this->db->where('remarks', $remarks);

        if ($remarks == 'Time-In') {
            $this->db->order_by('attendance_id', 'ASC');
        } else {
            $this->db->order_by('attendance_id', 'DESC');
        }
        
        $query = $this->db->get('attendance_record');
        return $query->row_array();
    }

    function get_excuse_letter($member_id, $schedule_date)
    {
        $this->db->where('member_id', $member_id);
        $this->db->where('attendance_date', $schedule_date);
        $query = $this->db->get('excuse_letter');
        return $query;
    }

    function download_excuse_letter($member_id, $attendance_date, $action)
    {
        $this->db->select('attachment');
        $this->db->from('excuse_letter');
        $this->db->where('member_id', $member_id);
        $this->db->where('attendance_date', $attendance_date);
        $this->db->where('letter_for', $action);
        $query = $this->db->get();
        return $query->row_array();
    }

    function save_validation($update_letter, $remarks, $member_id, $schedule_date)
    {
        $this->db->where('member_id', $member_id);
        $this->db->where('attendance_date', $schedule_date);
        $this->db->where('letter_for', $remarks);
        $update = $this->db->update('excuse_letter', $update_letter);
        return $update?TRUE:FALSE;
    }

    function get_selected_schedule($member_id)
    {
        $start_dt = date('Y-m-01');
        $end_date_obj = date('Y-m-t');

        $this->db->where('member_id', $member_id);
        $this->db->where('DATE(schedule_date) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(schedule_date) <=', $end_date_obj);
        $query = $this->db->get('scholar_selected_schedule');
        return $query->result();
    }
}