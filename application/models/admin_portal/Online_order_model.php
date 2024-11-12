<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class Online_order_model extends MY_Model
{
    var $order_details = 'order_details';
    var $order_details_order = array('order_no','no_items','referral_code','date_created','total_amount');
    var $order_details_search = array('order_no','no_items','referral_code','date_created','total_amount'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order = array('order_id' => 'DESC'); // default order
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

    public function get_pending_orders()
    {
        $this->_get_pending_orders_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_pending()
    {
        $this->_get_pending_orders_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_pending()
    {
        $this->db->from($this->order_details);
        if ($this->input->post('status')) {
            $this->db->where('order_status', $this->input->post('status'));
        } else {
            $this->db->where('order_status !=', 'Pending');
        }
        return $this->db->count_all_results();
    }

    private function _get_pending_orders_query()
    {
        $this->db->from($this->order_details);
        if ($this->input->post('status')) {
            $this->db->where('order_status', $this->input->post('status'));
        } else {
            $this->db->where('order_status !=', 'Pending');
        }
        
        $i = 0;
        foreach ($this->order_details_search as $item) // loop column 
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

                if (count($this->order_details_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->order_details_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
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

    function get_delivery_address($shipping_id)
    {
        $this->db->where('shipping_id', $shipping_id);
        $query = $this->db->get('delivery_address');
        return $query->row();
    }

    function get_referral_info($referral_code)
    {
        $this->db->where('referral_code', $referral_code);
        $query = $this->db->get('reseller_information');
        return $query;
    }

    function update_order_status($update_order, $order_id)
    {
        $this->db->where('order_id', $order_id);
        $update = $this->db->update('order_details', $update_order);
        return $update?TRUE:FALSE;
    }

    function get_user_referral_info($user_id)
    {
        $this->db->select('user_id, recruiter_id');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_acct');
        return $query->row();
    }


}