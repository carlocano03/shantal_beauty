<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class Product_model extends MY_Model
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

    function get_product_count($search_query, $filter)
    {
        if (!empty($search_query)) {
            $this->db->like('product_name', $search_query);
        }
        // Apply filter conditions
        switch ($filter) {
            case 'title_asc':
                $this->db->order_by('product_name', 'ASC');
                break;
            case 'title_desc':
                $this->db->order_by('product_name', 'DESC');
                break;
            case 'date_asc':
                $this->db->order_by('date_created', 'ASC');
                break;
            case 'date_desc':
                $this->db->order_by('date_created', 'DESC');
                break;
            case 'price_asc':
                $this->db->order_by('selling_price', 'ASC');
                break;
            case 'price_desc':
                $this->db->order_by('selling_price', 'DESC');
                break;
            default:
                $this->db->order_by('product_name', 'ASC'); // Default filter
                break;
        }
        $this->db->where('status', 0);
        return $this->db->count_all('product');
    }

    function get_product_list($limit, $start, $search_query, $filter)
    {
        if (!empty($search_query)) {
            $this->db->like('product_name', $search_query);
        }
        
        switch ($filter) {
            case 'title_asc':
                $this->db->order_by('product_name', 'ASC');
                break;
            case 'title_desc':
                $this->db->order_by('product_name', 'DESC');
                break;
            case 'date_asc':
                $this->db->order_by('date_created', 'ASC');
                break;
            case 'date_desc':
                $this->db->order_by('date_created', 'DESC');
                break;
            case 'price_asc':
                $this->db->order_by('selling_price', 'ASC');
                break;
            case 'price_desc':
                $this->db->order_by('selling_price', 'DESC');
                break;
            default:
                $this->db->order_by('product_name', 'ASC'); // Default filter
                break;
        }
        $this->db->limit($limit, $start);
        $this->db->where('status', 0);
        $query = $this->db->get('product');
        return $query;
    }

    function increment_cart($product_id, $user_id, $qty)
    {
        $this->db->set('quantity', 'quantity + ' . (int) $qty, FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->where('product_id', $product_id);
        return $this->db->update('cart_item');
    }

    function decrement_cart($product_id, $user_id)
    {
        $this->db->set('quantity', 'quantity - 1', FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->where('product_id', $product_id);
        return $this->db->update('cart_item');
    }

    function check_cart($product_id, $user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('product_id', $product_id);
        $this->db->where('status', 0);
        $query = $this->db->get('cart_item');
        return $query;
    }

    function insert_cart($insert_cart)
    {
        $insert = $this->db->insert('cart_item', $insert_cart);
        return $insert?TRUE:FALSE;
    }

    function insert_buy_now($insert_cart)
    {
        $insert = $this->db->insert('cart_item', $insert_cart);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return '';
        } 
    }

    function get_cart_count($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 0);
        $query = $this->db->get('cart_item');
        return $query->num_rows();
    }

    function get_cart_item_list($user_id)
    {
        $this->db->select('CI.*, P.product_name, P.selling_price, P.available_stocks, P.main_product_img');
        $this->db->from('cart_item CI');
        $this->db->join('product P', 'CI.product_id = P.product_id', 'left');
        $this->db->where('CI.user_id', $user_id);
        $this->db->where('CI.status', 0);
        $query = $this->db->get();
        return $query;
    }

    function increment_cart_qty($cart_id)
    {
        $this->db->set('quantity', 'quantity + 1', FALSE);
        $this->db->where('cart_id', $cart_id);
        return $this->db->update('cart_item');
    }

    function decrement_cart_qty($cart_id)
    {
        $this->db->set('quantity', 'quantity - 1', FALSE);
        $this->db->where('cart_id', $cart_id);
        return $this->db->update('cart_item');
    }

    function search_items($postData) {
        $response = array();

        if(isset($postData['term'])) {
            $this->db->from('product');
            $this->db->group_start();
                $this->db->where("product_name like '%". $postData['term'] . "%'");
            $this->db->group_end();
            $records = $this->db->get()->result();

            foreach($records as $row) {
                $response[] = array(
                    "label" => $row->product_name,
                    "value" => $row->product_name
                );
            }
        }
        return $response;
    }

    function delete_cart_item($cart_id)
    {
        $this->db->where('cart_id', $cart_id);
        $delete = $this->db->delete('cart_item');
        return $delete?TRUE:FALSE;
    }

    function get_total_sold($product_id)
    {
        $this->db->select("SUM(OI.quantity_order) as total_sold");
        $this->db->from('order_items OI');
        $this->db->join('order_details OD', 'OI.order_id = OD.order_id', 'left');
        $this->db->where('OI.product_id', $product_id);
        $this->db->where('OD.order_status', 'Completed');
        $query = $this->db->get();
        return $query->row();
    }

    //Checkout page
    function get_cart_data($cart_ids_decrypted)
    {
        $this->db->select('CI.*, P.product_name, P.selling_price, P.available_stocks, P.main_product_img');
        $this->db->from('cart_item CI');
        $this->db->join('product P', 'CI.product_id = P.product_id', 'left');
        // $this->db->where('CI.status', 0);
        $this->db->where_in('cart_id', $cart_ids_decrypted);
        $query = $this->db->get();
        return $query->result();
    }

    function get_default_address()
    {
        $this->db->where('user_id', $this->session->userdata('customerIn')['user_id']);
        $this->db->where('set_as_default', 1);
        $this->db->where('status', 0);
        $query = $this->db->get('delivery_address');
        return $query;
    }

    function get_delivery_address_list($user_id)
    {
        $this->db->where('user_id', $this->session->userdata('customerIn')['user_id']);
        $this->db->where('status', 0);
        $query = $this->db->get('delivery_address');
        return $query;
    }

    function get_province()
    {
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('psgc_province');
        return $query->result();
    }

    function insert_delivery_address($insert_default)
    {
        $insert = $this->db->insert('delivery_address', $insert_default);
        return $insert?TRUE:FALSE;
    }

    function update_address($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('delivery_address', array('set_as_default' => 0, 'selected_address' => 0));
    }

    function get_selected_address()
    {
        $this->db->where('user_id', $this->session->userdata('customerIn')['user_id']);
        $this->db->where('selected_address', 1);
        $this->db->where('status', 0);
        $query = $this->db->get('delivery_address');
        return $query;
    }

    function change_delivery_address($shipping_id)
    {
        $this->db->where('user_id', $this->session->userdata('customerIn')['user_id']);
        $update = $this->db->update('delivery_address', array('selected_address' => 0)); 
        if ($update) {
            $this->db->where('shipping_id', $shipping_id);
            $this->db->update('delivery_address', array('selected_address' => 1));
        }
        return $update?TRUE:FALSE;
    }

    function delete_address($shipping_id)
    {
        $this->db->where('shipping_id', $shipping_id);
        $update = $this->db->update('delivery_address', array('status' => 1));
        return $update?TRUE:FALSE;
    }

    function check_referral_code($referral_code)
    {
        $this->db->where('referral_code', $referral_code);
        $query = $this->db->get('reseller_information');
        return $query;
    }

    function check_voucher_code($voucher_code, $reseller_id)
    {
        $this->db->where('voucher_code', $voucher_code);
        $this->db->where('reseller_id', $reseller_id);
        $this->db->where('request_status', 'Approved');
        $query = $this->db->get('voucher');
        return $query;
    }

    function process_checkout($insert_order)
    {
        $insert = $this->db->insert('order_details', $insert_order);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return '';
        } 
    }

    function insert_order_product($insert_order_product)
    {
        return $this->db->insert('order_items', $insert_order_product);
    }
    //End of checkout page

    //Recommended product

    function get_recommended_product($product_id)
    {
        $this->db->limit(4);
        $this->db->where('status', 0);
        $this->db->where('product_id !=', $product_id);
        $query = $this->db->get('product');
        return $query;
    }

    //End of recommended product

    //Wishlist

    function check_wishlist($product_id, $user_id)
    {
        $this->db->where('product_id', $product_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('wishlist');
        return $query;
    }

    function increment_wish_list($product_id, $user_id, $qty)
    {
        $this->db->set('qty', 'qty + ' . (int) $qty, FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->where('product_id', $product_id);
        return $this->db->update('wishlist');
    }

    function insert_wishlist($insert_wishlist)
    {
        return $this->db->insert('wishlist', $insert_wishlist);
    }

    function get_wishlist_count($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 0);
        $query = $this->db->get('wishlist');
        return $query->num_rows();
    }
    //End of wishlist
}