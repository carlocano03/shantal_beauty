<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class My_commission_model extends MY_Model
{
    var $reseller_acct = 'reseller_information';
    var $reseller_acct_order = array('reseller_no', 'first_name', 'last_name', 'email_address', 'date_created', 'status');
    var $reseller_acct_search = array('reseller_no', 'first_name', 'last_name', 'email_address', 'date_created', 'status'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order_acct = array('reseller_id' => 'ASC'); // default order

    var $commission = 'reseller_commission';
    var $commission_order = array('OR.order_no', 'RC.sales_amount', 'RC.commission_amt', 'RC.remarks');
    var $commission_search = array('OR.order_no', 'RC.sales_amount', 'RC.commission_amt', 'RC.remarks'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order_commission = array('RC.commission_id' => 'ASC'); // default order
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

    function get_reseller_count()
    {
        $this->db->where('referred_by', $this->session->userdata('resellerIn')['referral_code']);
        $this->db->where('status', 0);
        $query = $this->db->get('reseller_information');
        return $query->num_rows();
    }

    public function get_recruited_reseller()
    {
        $this->_get_recruited_reseller_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_reseller()
    {
        $this->_get_recruited_reseller_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_reseller()
    {
        $status = $this->input->post('status', true);
        $this->db->from($this->reseller_acct);
        $this->db->where('referred_by', $this->session->userdata('resellerIn')['referral_code']);
        return $this->db->count_all_results();
    }

    private function _get_recruited_reseller_query()
    {
        $status = $this->input->post('status', true);
        $this->db->from($this->reseller_acct);
        $this->db->where('referred_by', $this->session->userdata('resellerIn')['referral_code']);
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

    public function get_my_sales()
    {
        $this->_get_my_sales_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_sales()
    {
        $this->_get_my_sales_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_sales()
    {
        $this->db->select('RC.*, OR.order_no');
        $this->db->from($this->commission.' RC');
        $this->db->join('order_details OR', 'RC.order_id = OR.order_id', 'left');
        $this->db->where('RC.user_id', $this->session->userdata('resellerIn')['user_id']);
        return $this->db->count_all_results();
    }

    private function _get_my_sales_query()
    {
        $this->db->select('RC.*, OR.order_no');
        $this->db->from($this->commission.' RC');
        $this->db->join('order_details OR', 'RC.order_id = OR.order_id', 'left');
        $this->db->where('RC.user_id', $this->session->userdata('resellerIn')['user_id']);
        $i = 0;
        foreach ($this->commission_search as $item) // loop column 
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

                if (count($this->commission_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->commission_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_commission)) {
            $order = $this->order_commission;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_commission_amt()
    {
        $this->db->select("SUM(commission_amt) as total_commission");
        $this->db->where('user_id', $this->session->userdata('resellerIn')['user_id']);
        $query = $this->db->get('reseller_commission');
        return $query->row();
    }

    function get_referral_info($referral_code)
    {
        $this->db->where('referral_code', $referral_code);
        $query = $this->db->get('reseller_information');
        return $query;
    }

    function order_details($order_id)
    {
        $this->db->select('
            OI.*, 
            P.product_name, 
            P.description, 
            P.selling_price, 
            P.available_stocks, 
            P.main_product_img, 
            GROUP_CONCAT(PS.batch_lot_no ORDER BY PS.expiration_date ASC) AS batch_lot_numbers, 
            GROUP_CONCAT(PS.stocks ORDER BY PS.expiration_date ASC) AS batch_stocks,
            GROUP_CONCAT(PS.stock_id ORDER BY PS.expiration_date ASC) AS stock_ids
        ');
        $this->db->from('order_items OI');
        $this->db->join('product P', 'OI.product_id = P.product_id', 'left');
        $this->db->join('product_stocks PS', 'P.product_id = PS.product_id', 'left');
        $this->db->where('OI.order_id', $order_id);
        $this->db->group_by('OI.product_id'); // Group by product to avoid duplication
        $query = $this->db->get();
        
        return $query->result();
    }

}