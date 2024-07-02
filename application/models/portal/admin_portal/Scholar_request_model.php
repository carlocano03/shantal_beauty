<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class Scholar_request_model extends MY_Model
{
    var $scholar = 'scholarship_application';
    var $scholar_order = array('application_no', 'student_last_name', 'student_first_name', 'student_middle_name', 'school_name', 'date_application', 'application_status');
    var $scholar_search = array('application_no', 'student_last_name', 'student_first_name', 'student_middle_name', 'school_name', 'date_application', 'application_status'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order = array('application_id' => 'ASC'); // default order

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

    public function get_scholar_list()
    {
        $this->_get_scholar_list_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_scholar_list_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->scholar);
        return $this->db->count_all_results();
    }

    private function _get_scholar_list_query()
    {
        $this->db->from($this->scholar);
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

    function check_existing_student($student_first_name, $student_last_name, $birthday)
    {
        $this->db->where('student_first_name', $student_first_name);
        $this->db->where('student_last_name', $student_last_name);
        $this->db->where('birthday', $birthday);
        $query = $this->db->get('scholarship_member');
        return $query;
    }

    function insert_member_details($insert_member)
    {
        $insert = $this->db->insert('scholarship_member', $insert_member);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return '';
        }
    }

    function update_scholarship_application($application_id)
    {
        $this->db->where('application_id', $application_id);
        return $this->db->update('scholarship_application', array('application_status' => 'Approved'));
    }

    function insert_user_acct($member_account)
    {
        $insert = $this->db->insert('user_acct', $member_account);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return '';
        } 
    }

    function update_member_details($user_id, $member_id)
    {
        $this->db->where('member_id', $member_id);
        return $this->db->update('scholarship_member', array('user_id' => $user_id));
    }

}