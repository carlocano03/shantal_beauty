<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class My_order_model extends MY_Model
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

    function get_count_order($status)
    {
        $this->db->where('user_id', $this->session->userdata('customerIn')['user_id']);
        $this->db->where('order_status', $status);
        $query = $this->db->get('order_details');
        return $query;
    }

    function get_order_list($status)
    {
        $this->db->select('order_id, order_no, date_created, shipping_fee, total_amount, order_status');
        $this->db->where('order_status', $status);
        $this->db->where('user_id', $this->session->userdata('customerIn')['user_id']);
        $query = $this->db->get('order_details');
        return $query;
    }

    function get_order_details($order_id)
    {
        $this->db->select('P.product_name, P.selling_price, P.main_product_img, OI.product_id, OI.quantity_order');
        $this->db->from('order_items OI');
        $this->db->join('product P', 'OI.product_id = P.product_id', 'left');
        $this->db->where('OI.order_id', $order_id);
        $query = $this->db->get();
        return $query->result();
    }

    function check_order($order_id)
    {
        $this->db->where('order_id', $order_id);
        $this->db->where('order_status', 'Pending');
        $query = $this->db->get('order_details');
        return $query;
    }

    function update_order_status($update_order, $order_id)
    {
        $this->db->where('order_id', $order_id);
        $update = $this->db->update('order_details', $update_order);
        return $update?TRUE:FALSE;
    }

    function tracking_order($order_id)
    {
        $this->db->where('order_id', $order_id);
        $this->db->order_by('track_id', 'DESC');
        $query = $this->db->get('track_order');
        return $query;
    }

}