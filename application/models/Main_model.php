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


}