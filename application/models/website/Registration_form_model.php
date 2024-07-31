<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2022,
 *
 */
class Registration_form_model extends MY_Model
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

    function check_student_email($email_address)
    {
        $this->db->from('scholarship_application');
        $this->db->where('email_address', $email_address);
        $this->db->where('application_status !=', 'Declined');
        $this->db->where('status', 0);
        $query = $this->db->get();
        return $query;
    }

    function insert_otp_no($insert_otp)
    {
        $insert = $this->db->insert('email_otp', $insert_otp);
        return $insert ? TRUE : FALSE;
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

    function check_existing_student($student_first_name, $student_last_name, $birthday)
    {
        $this->db->where('student_first_name', $student_first_name);
        $this->db->where('student_last_name', $student_last_name);
        $this->db->where('birthday', $birthday);
        $query = $this->db->get('scholarship_application');
        return $query;
    }

    function insert_scholarship_registration($insert_registration)
    {
        $insert = $this->db->insert('scholarship_application', $insert_registration);
        return $insert?TRUE:FALSE;
    }

    function get_deadline_filling()
    {
        $this->db->where('status', 0);
        $this->db->limit(1);
        $query = $this->db->get('deadline_filling_scholarship');
        return $query->row();
    }

    function get_citizenship()
    {
        $this->db->where('status', 0);
        $this->db->order_by("CASE WHEN country_name = 'Philippines' THEN 1 ELSE 2 END, country_name", 'ASC');
        $query = $this->db->get('country');
        return $query->result();
    }

    function get_civil_status()
    {
        $this->db->where('status', 0);
        $query = $this->db->get('civil_status');
        return $query->result();
    }
}