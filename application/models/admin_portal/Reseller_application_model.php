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

    var $voucher = 'voucher';
    var $voucher_order = array('RI.first_name','RI.last_name','V.vocuher_code','V.description','V.date_created','V.end_date','V.request_status');
    var $voucher_search = array('RI.first_name','RI.last_name','V.vocuher_code','V.description','V.date_created','V.end_date','V.request_status'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order_voucher = array('V.voucher_id' => 'ASC'); // default order

    var $order_details = 'order_details';
    var $details_order = array('P.product_name','OI.quantity_order');
    var $order_search = array('P.product_name','OI.quantity_order'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order_details_order = array('OD.order_id' => 'DESC'); // default order

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

    //==============================Voucher=================================

    public function get_voucher_list()
    {
        $this->_get_voucher_list_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_voucher()
    {
        $this->_get_voucher_list_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_voucher()
    {
        $this->db->select('V.*, RI.reseller_no');
        $this->db->select("CONCAT(RI.first_name,' ',RI.last_name) as reseller_name");
        $this->db->from($this->voucher.' V');
        $this->db->join('reseller_information RI', 'V.reseller_id = RI.reseller_id', 'left');
        $this->db->where('V.is_deleted IS NULL');
        if ($this->input->post('status', true)) {
            $this->db->where('V.request_status', $this->input->post('status', true));
        }
        return $this->db->count_all_results();
    }

    private function _get_voucher_list_query()
    {
        $this->db->select('V.*, RI.reseller_no');
        $this->db->select("CONCAT(RI.first_name,' ',RI.last_name) as reseller_name");
        $this->db->from($this->voucher.' V');
        $this->db->join('reseller_information RI', 'V.reseller_id = RI.reseller_id', 'left');
        $this->db->where('V.is_deleted IS NULL');
        if ($this->input->post('status', true)) {
            $this->db->where('V.request_status', $this->input->post('status', true));
        }
        $i = 0;
        foreach ($this->voucher_search as $item) // loop column 
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

                if (count($this->voucher_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->voucher_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_voucher)) {
            $order = $this->order_voucher;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function voucher_approval($update_voucher, $voucher_id)
    {
        $this->db->where('voucher_id', $voucher_id);
        $update = $this->db->update('voucher', $update_voucher);
        return $update?TRUE:FALSE;
    }

    //==============================End of Voucher==========================

    function get_sales_chart($range = '', $referral_code)
    {
        $today = date('Y-m-d');
        $prevRange = date('Y-m-d', strtotime('-1 week'));

        // Define the date range based on the selected range
        if ($range == '1') {
            $prevRange = date('Y-m-d', strtotime('-1 week'));
        } elseif ($range == '2') {
            $prevRange = date('Y-m-d', strtotime('-1 month'));
        } elseif ($range == '3') {
            $prevRange = date('Y-m-d', strtotime('-1 year'));
        }

        $dateRange = [];
        $currentDate = $today;

        // Create an array of dates from the previous range to today
        while ($currentDate >= $prevRange) {
            $dateRange[] = $currentDate;
            $currentDate = date('Y-m-d', strtotime('-1 day', strtotime($currentDate)));
        }

        $dateRange = array_reverse($dateRange);

        // Create dynamic columns for the query
        $selectColumns = [];
        foreach ($dateRange as $date) {
            // Count items sold on each specific date
            $selectColumns[] = "IFNULL(SUM(CASE WHEN DATE(date_created) = '$date' THEN no_items ELSE 0 END), 0) AS '$date'";
        }

        // Prepare the query
        $this->db->select('\'Sold Products\' AS sales_status', FALSE);
        $this->db->select('IFNULL(SUM(no_items), 0) AS sales_count', FALSE);
        $this->db->select(implode(', ', $selectColumns));
        $this->db->from('order_details');
        $this->db->where('date_created >=', $prevRange.' 00:00:00');
        $this->db->where('date_created <=', $today.' 23:59:59');
        $this->db->where('order_status', 'Completed');
        $this->db->where('referral_code', $referral_code);
        $salesReport = $this->db->get()->row_array();

        // Initialize the sales report with zeroes for missing dates
        foreach ($dateRange as $date) {
            if (!isset($salesReport[$date])) {
                $salesReport[$date] = 0; // Ensure it's an integer for charting
            }
        }

        return array($salesReport);
    }

    public function get_product_sales()
    {
        $this->_get_product_sales_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_sales()
    {
        $this->_get_product_sales_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_sales()
    {
        $this->db->select('OD.*, P.product_name, P.selling_price, OI.quantity_order');
        $this->db->from($this->order_details.' OD');
        $this->db->join('order_items OI', 'OD.order_id = OI.order_id', 'left');
        $this->db->join('product P', 'OI.product_id = P.product_id', 'left');
        $this->db->where('OD.order_status', 'Completed');
        $this->db->where('OD.referral_code', $this->input->post('referral_code', true));
        return $this->db->count_all_results();
    }

    private function _get_product_sales_query()
    {
        $this->db->select('OD.*, P.product_name, P.selling_price, OI.quantity_order');
        $this->db->from($this->order_details.' OD');
        $this->db->join('order_items OI', 'OD.order_id = OI.order_id', 'left');
        $this->db->join('product P', 'OI.product_id = P.product_id', 'left');
        $this->db->where('OD.order_status', 'Completed');
        $this->db->where('OD.referral_code', $this->input->post('referral_code', true));
        $i = 0;
        foreach ($this->order_search as $item) // loop column 
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

                if (count($this->order_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->details_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_details_order)) {
            $order = $this->order_details_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


}