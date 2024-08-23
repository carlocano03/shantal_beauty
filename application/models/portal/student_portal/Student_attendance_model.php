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
    var $letter = 'explanation_letter';
    var $letter_order = array('attendance_date','remarks','date_created','request_status','time_in_out');
    var $letter_search = array('attendance_date','remarks','date_created','request_status','time_in_out'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order = array('letter_id' => 'DESC'); // default order
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

    function check_schedule($month)
    {
        $start_dt = date('Y-m-01', strtotime($month));
        $end_date_obj = date('Y-m-t', strtotime($month));

        $this->db->where('member_id', $this->session->userdata('scholarIn')['member_id']);
        $this->db->where('DATE(date_from) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(date_from) <=', $end_date_obj);
        $query = $this->db->get('scholar_schedule');
        return $query;
    }

    function get_student_schedule_list($month)
    {
        $start_dt = date('Y-m-01', strtotime($month));
        $end_date_obj = date('Y-m-t', strtotime($month));

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

    function get_attendance($member_id, $schedule_date, $remarks)
    {
        $this->db->where('member_id', $member_id);
        $this->db->where('attendance_date', $schedule_date);
        $this->db->where('remarks', $remarks);

        if ($remarks == 'Time-In') {
            $this->db->order_by('attendance_id', 'ASC');
        } else {
            $this->db->order_by('attendance_id', 'ASC');
        }
        
        $query = $this->db->get('attendance_record');
        return $query->row_array();
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

    //==========No Time In/Out Record=========================
    
    public function get_explanation_letter()
    {
        $this->_get_explanation_letter_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
	

    public function count_filtered()
    {
        $this->_get_explanation_letter_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->where('member_id', $this->session->userdata('scholarIn')['member_id']);
        $this->db->where('status', 0);
        $this->db->from($this->letter);
        return $this->db->count_all_results();
    }

    private function _get_explanation_letter_query()
    {
        $this->db->where('member_id', $this->session->userdata('scholarIn')['member_id']);
        $this->db->where('status', 0);
        $this->db->from($this->letter);
        $i = 0;
        foreach ($this->letter_search as $item) // loop column 
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

                if (count($this->letter_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->letter_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function check_existing_request($attendance_date, $options)
    {
        $this->db->where('attendance_date', $attendance_date);
        $this->db->where('remarks', $options);
        $this->db->where('member_id', $this->session->userdata('scholarIn')['member_id']);
        $this->db->where('status', 0);
        $query = $this->db->get($this->letter);
        return $query;
    }

    function get_scholar_schedule()
    {
        $start_dt = date('Y-m-01');
        $end_date_obj = date('Y-m-t');

        $this->db->where('member_id', $this->session->userdata('scholarIn')['member_id']);
        $this->db->where('DATE(schedule_date) >=', $start_dt);  // Adjust the year as needed
        $this->db->where('DATE(schedule_date) <=', $end_date_obj);
        $query = $this->db->get('scholar_selected_schedule');
        return $query->result();
    }

    function save_explanation($insert_explanation)
    {   
        $insert = $this->db->insert('explanation_letter', $insert_explanation);
        return $insert?TRUE:FALSE;
    }

    function delete_explanation_letter($delete_request, $letter_id)
    {
        $this->db->where('letter_id', $letter_id);
        $update = $this->db->update('explanation_letter', $delete_request);
        return $update?TRUE:FALSE;
    }
    

    //==========End No Time In/Out Record=========================

}