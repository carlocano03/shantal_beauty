<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class Reseller_application_model extends MY_Model
{
    var $reseller = 'reseller_application';
    var $reseller_order = array('application_no', 'first_name', 'last_name', 'date_created', 'request_status');
    var $reseller_search = array('application_no', 'first_name', 'last_name', 'date_created', 'request_status'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order_reseller = array('application_id' => 'ASC'); // default order

    var $reseller_acct = 'reseller_information';
    var $reseller_acct_order = array('reseller_no', 'first_name', 'last_name', 'email_address', 'date_created', 'status');
    var $reseller_acct_search = array('reseller_no', 'first_name', 'last_name', 'email_address', 'date_created', 'status'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order_acct = array('reseller_id' => 'ASC'); // default order

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

    public function get_reseller_application()
    {
        $this->_get_reseller_application_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_reseller_application_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->reseller);
        $this->db->where('request_status', 'For Validation');
        return $this->db->count_all_results();
    }

    private function _get_reseller_application_query()
    {
        $this->db->from($this->reseller);
        $this->db->where('request_status', 'For Validation');
        $i = 0;
        foreach ($this->reseller_search as $item) // loop column 
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

                if (count($this->reseller_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->reseller_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_reseller)) {
            $order = $this->order_reseller;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function insert_reseller_details($insert_reseller)
    {
        $insert = $this->db->insert('reseller_information', $insert_reseller);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return '';
        }
    }

    function update_reseller_application($application_id)
    {
        $this->db->where('application_id', $application_id);
        return $this->db->update('reseller_application', array('request_status' => 'Approved'));
    }

    function insert_user_acct($reseller_account)
    {
        $insert = $this->db->insert('user_acct', $reseller_account);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return '';
        } 
    }

    function update_reseller_details($user_id, $reseller_id)
    {
        $this->db->where('reseller_id', $reseller_id);
        return $this->db->update('reseller_information', array('user_id' => $user_id));
    }

    function decline_application($decline_application, $application_id)
    {
        $this->db->where('application_id', $application_id);
        $update = $this->db->update('reseller_application', $decline_application);
        return $update?TRUE:FALSE;
    }

    function check_existing_referral($referral_code)
    {
        $this->db->where('referral_code', $referral_code);
        $query = $this->db->get('reseller_information');
        return $query->row();
    }

    //========================Reseller Account==============================
    public function get_reseller_account()
    {
        $this->_get_reseller_account_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_reseller()
    {
        $this->_get_reseller_account_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_reseller()
    {
        $status = $this->input->post('status', true);
        $this->db->from($this->reseller_acct);
        if ($status == 'Active') {
            $this->db->where('status', 0);
        } else {
            $this->db->where('status', 1);
        }
        return $this->db->count_all_results();
    }

    private function _get_reseller_account_query()
    {
        $status = $this->input->post('status', true);
        $this->db->from($this->reseller_acct);
        if ($status == 'Active') {
            $this->db->where('status', 0);
        } else {
            $this->db->where('status', 1);
        }
        $i = 0;
        foreach ($this->reseller_acct_search as $item) // loop column 
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

                if (count($this->reseller_acct_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->reseller_acct_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_acct)) {
            $order = $this->order_acct;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_reseller_count($status)
    {
        $this->db->where('status', $status);
        $query = $this->db->get($this->reseller_acct);
        return $query->num_rows();
    }

    function get_referred_name($referred_by)
    {
        $this->db->select("CONCAT(first_name, ' ', last_name) as referred_name");
        $this->db->select('referral_code');
        $this->db->where('referral_code', $referred_by);
        $this->db->where('status', 0);
        $query = $this->db->get('reseller_information');
        return $query->row_array();
    }

    function update_reseller_status($reseller_id, $update_status)
    {
        $this->db->where('reseller_id', $reseller_id);
        $update = $this->db->update('reseller_information', $update_status);
        return $update?TRUE:FALSE;
    }

}