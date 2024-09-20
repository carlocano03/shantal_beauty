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

    //Checkout page
    function get_cart_data($cart_ids_decrypted)
    {
        $this->db->select('CI.*, P.product_name, P.selling_price, P.available_stocks, P.main_product_img');
        $this->db->from('cart_item CI');
        $this->db->join('product P', 'CI.product_id = P.product_id', 'left');
        $this->db->where('CI.status', 0);
        $this->db->where_in('cart_id', $cart_ids_decrypted);
        $query = $this->db->get();
        return $query->result();
    }
    //End of checkout page

}