<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class Biometric_logs_model extends MY_Model
{
    var $attendance = 'attendance_record';
    var $attendance_order = array('SM.scholarship_no','SM.student_last_name','SM.student_first_name','SM.student_middle_name','AR.attendance_date','AR.time_transaction','AR.remarks');
    var $attendance_search = array('SM.scholarship_no','SM.student_last_name','SM.student_first_name','SM.student_middle_name','AR.attendance_date','AR.time_transaction','AR.remarks'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order = array('AR.attendance_date' => 'DESC'); // default order
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

    public function get_biometric_logs()
    {
        $this->_get_biometric_logs_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_biometric_logs_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select('AR.*, SM.personal_photo, SM.scholarship_no');
        $this->db->select("CONCAT(SM.student_last_name, ', ', SM.student_first_name, ' ',SM.student_middle_name) as scholar");
        $this->db->from($this->attendance.' AR');
        $this->db->join('scholarship_member SM', 'AR.member_id = SM.member_id', 'left');
        $this->db->where('AR.status', 0);
        return $this->db->count_all_results();
    }

    private function _get_biometric_logs_query()
    {
        $this->db->select('AR.*, SM.personal_photo, SM.scholarship_no');
        $this->db->select("CONCAT(SM.student_last_name, ', ', SM.student_first_name, ' ',SM.student_middle_name) as scholar");
        $this->db->from($this->attendance.' AR');
        $this->db->join('scholarship_member SM', 'AR.member_id = SM.member_id', 'left');
        $this->db->where('AR.status', 0);
        $i = 0;
        foreach ($this->attendance_search as $item) // loop column 
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

                if (count($this->attendance_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->attendance_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

}