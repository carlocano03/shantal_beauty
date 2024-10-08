<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
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

    private function verify_password_hash($password, $hash)
    {
        return password_verify($password, $hash);
    }

    function user_check($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('user_type_id', RESELLER_USER);
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
        $this->db->where('user_type_id', RESELLER_USER);
        $query = $this->db->get('user_acct');
        return $query->num_rows();
    }

    function get_user_details($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('reseller_information');
        return $query->row_array();
    }

    function check_old_pass($old_pass) 
    {
        $this->db->where('user_id', $this->session->userdata('resellerIn')['user_id']);
        $res = $this->db->get('user_acct')->row_array();
        if (!$res) {
            return false;
        } else {
            $hash = $res['password'];
            if ($this->verify_password_hash($old_pass, $hash)) {
                return $res;
            } else {
                return false;
            }
        }
    }

    function update_password($update_password)
    {
        $this->db->where('user_id', $this->session->userdata('resellerIn')['user_id']);
        $update = $this->db->update('user_acct', $update_password);
        return $update?TRUE:FALSE;
    }

}