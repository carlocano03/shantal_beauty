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

    function get_total_scholar()
    {
        $this->db->where('member_status', 'Member');
        $query = $this->db->get('scholarship_member');
        return $query;
    }

    function get_total_application()
    {
        $query = $this->db->get('scholarship_application');
        return $query;
    }

    function get_total_approval($status)
    {
        $this->db->where('application_status', $status);
        $query = $this->db->get('scholarship_application');
        return $query;
    }

    function getScholarshipRequest()
    {
        $this->db->where('application_status', 'For Approval');
        $this->db->limit(2);
        $this->db->order_by('date_application', 'DESC');
        $query = $this->db->get('scholarship_application');
        return $query;
    }

    function getAvailableSched()
    {
        $this->db->where('status', 0);
        $query = $this->db->get('church_schedule');
        return $query;
    }

    function applicationChart($range='')
    {
        $today = date('Y-m-d');
        $prevRange = date('Y-m-d', strtotime('-1 week'));

        if ($range == '1') {
            $prevRange = date('Y-m-d', strtotime('-1 week'));
        } elseif ($range == '2') {
            $prevRange = date('Y-m-d', strtotime('-1 month'));
        } elseif ($range == '3') {
            $prevRange = date('Y-m-d', strtotime('-1 year'));
        }

        $dateRange = [];
        $currentDate = $today;
        while ($currentDate >= $prevRange) {
            $dateRange[] = $currentDate;
            $currentDate = date('Y-m-d', strtotime('-1 day', strtotime($currentDate)));
        }

        $dateRange = array_reverse($dateRange);

        $selectColumns = [];
        foreach ($dateRange as $date) {
            $selectColumns[] = "IFNULL(COUNT(DISTINCT CASE WHEN DATE(date_application) = '$date' THEN application_id ELSE NULL END), 0) AS '$date'";
        }

        // Query for total application
        $this->db->select('\'Total Application\' AS application_status', FALSE);
        $this->db->select('IFNULL(COUNT(application_id), 0) AS total_count', FALSE);
        $this->db->select(implode(', ', $selectColumns));
        $this->db->from('scholarship_application');
        $this->db->where('status', 0);
        $this->db->where('date_application >=', $prevRange.' 00:00:00');
        $this->db->where('date_application <=', $today.' 23:59:59');
        $application = $this->db->get()->row_array();

        // Query for total approved
        $this->db->select('\'Approved\' AS application_status', FALSE);
        $this->db->select('IFNULL(COUNT(application_id), 0) AS total_count', FALSE);
        $this->db->select(implode(', ', $selectColumns));
        $this->db->from('scholarship_application');
        $this->db->where('application_status', 'Approved');
        $this->db->where('date_application >=', $prevRange.' 00:00:00');
        $this->db->where('date_application <=', $today.' 23:59:59');
        $approved = $this->db->get()->row_array();

        // Query for total declined
        $this->db->select('\'Declined\' AS application_status', FALSE);
        $this->db->select('IFNULL(COUNT(application_id), 0) AS total_count', FALSE);
        $this->db->select(implode(', ', $selectColumns));
        $this->db->from('scholarship_application');
        $this->db->where('application_status', 'Declined');
        $this->db->where('date_application >=', $prevRange.' 00:00:00');
        $this->db->where('date_application <=', $today.' 23:59:59');
        $declined = $this->db->get()->row_array();

        // Ensure all date columns are set to 0 if not present
        foreach ($dateRange as $date) {
            if (!isset($application[$date])) {
                $application[$date] = '0';
            }
            if (!isset($approved[$date])) {
                $approved[$date] = '0';
            }
            if (!isset($declined[$date])) {
                $declined[$date] = '0';
            }
        }
        
        return array(
            $application,
            $approved,
            $declined
        );
    }

    function check_old_pass($old_pass) 
    {
        $this->db->where('user_id', $this->session->userdata('adminIn')['user_id']);
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

    private function verify_password_hash($old_pass, $hash)
    {
        return password_verify($old_pass, $hash);
    }

    function update_password($update_password)
    {
        $this->db->where('user_id', $this->session->userdata('adminIn')['user_id']);
        $update = $this->db->update('user_acct', $update_password);
        return $update?TRUE:FALSE;
    }

	function insert_event($data)
    {
      return $this->db->insert('events',$data);
    }
    

}