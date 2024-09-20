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

    function check_email_address($email_address)
    {
        $this->db->where('email_address', $email_address);
        $query = $this->db->get('user_details');
        return $query;
    }

    function signup_user($insert_details)
    {
        $insert = $this->db->insert('user_details', $insert_details);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return '';
        } 
    }

    function insert_user_acct($customer_account)
    {
        $insert = $this->db->insert('user_acct', $customer_account);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return '';
        } 
    }

    function update_user_details($user_id, $user_details_id)
    {
        $this->db->where('user_details_id', $user_details_id);
        $this->db->update('user_details', array('user_id' => $user_id));
    }

    function insert_otp_no($insert_otp)
    {
        $this->db->insert('email_otp', $insert_otp);
    }

    function check_otp($otp_no, $email_address)
    {
        $this->db->where('otp_no', $otp_no);
        $this->db->where('email_address', $email_address);
        $this->db->where('otp_status', 0);
        $query = $this->db->get('email_otp');
        return $query;
    }

    function check_expiration($otp_no, $email_address)
    {
        $current_time = date('Y-m-d H:i:s');
        $this->db->where('otp_no', $otp_no);
        $this->db->where('email_address', $email_address);
        $this->db->where('otp_status', 0);
        $this->db->where('expiration_time >', $current_time);
        $query = $this->db->get('email_otp');
        return $query;
    }

    function update_otp($update_otp, $otp_no, $email_address)
    {
        $this->db->where('otp_no', $otp_no);
        $this->db->where('email_address', $email_address);
        $update = $this->db->update('email_otp', $update_otp);
        return $update ? TRUE : FALSE;
    }

    function update_user_verification($user_details_id)
    {
        $this->db->where('user_details_id', $user_details_id);
        $this->db->update('user_details', array('email_verification' => 'Verified'));
    }

    private function verify_password_hash($password, $hash)
    {
        return password_verify($password, $hash);
    }

    function user_check($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('user_type_id', CUSTOMER);
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
        $this->db->where('user_type_id', CUSTOMER);
        $query = $this->db->get('user_acct');
        return $query->num_rows();
    }

    function get_user_details($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_details');
        return $query->row_array();
    }

}