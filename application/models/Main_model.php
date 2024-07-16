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
        // $this->load->database();
    }

    function get_auto_reply_info()
    {
        $query = $this->db->get('autoreply_credentials');
        return $query->row_array();
    }

    function user_check($username, $password)
    {
        $this->db->where('username', $username);
        $res = $this->db->get('user_acct')->row_array();
        if (!$res) {
            return false;
        } else {
            $hash = $res['password'];
            if ($this->verify_password_hash($password, $hash)) {
                return $res;
            } else {
                return false;
            }
        }
    }
    
    function userCheck($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('user_acct');
        return $query->num_rows();
    }

    private function verify_password_hash($password, $hash)
    {
        return password_verify($password, $hash);
    }

    function get_user_details($user_id, $user_type_id)
    {
        switch ($user_type_id) {
            case ADMINISTRATOR:
            case ADMIN_STAFF:
                $this->db->where('user_id', $user_id);
                $query = $this->db->get('admin_user_details');
                break;
            
            case STUDENT:
                $this->db->where('user_id', $user_id);
                $query = $this->db->get('scholarship_member');
                break;
        }
        return $query->row_array();
    }

    function insert_activity_logs($logs)
    {
        return $this->db->insert('recent_activities', $logs);
    }

    function getRecentActivities()
    {
        $this->db->select('RA.*, AU.active_email');
        $this->db->select("CONCAT(AU.first_name,' ',AU.last_name) as user_name");
        $this->db->from('recent_activities RA');
        $this->db->join('admin_user_details AU', 'RA.user_id = AU.user_id', 'left');
        $this->db->limit(5);
        $this->db->order_by('logs_id', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    function get_student_info($user_id)
    {
        $this->db->select("CONCAT(student_first_name,' ',student_last_name) as user_name");
        $this->db->from('scholarship_member');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->row();
    }

    function getDeadlineFilling()
    {
        $this->db->where('status', 0);
        $this->db->limit(1);
        $query = $this->db->get('deadline_filling_scholarship');
        return $query;
    }

    function save_deadline($insert_deadline)
    {
        $insert = $this->db->insert('deadline_filling_scholarship', $insert_deadline);
        if ($insert) {
            $deadline_id = $this->db->insert_id();
            $this->db->where('deadline_id !=', $deadline_id);
            $this->db->update('deadline_filling_scholarship', array('status' => 1));
            return $deadline_id;
        } else {
            return '';
        } 
    }

    function get_church_schedule()
    {
        $this->db->where('status', 0);
        $query = $this->db->get('church_schedule');
        return $query->result();
    }
}