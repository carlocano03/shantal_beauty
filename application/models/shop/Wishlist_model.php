<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class Wishlist_model extends MY_Model
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
                $this->db->order_by('P.product_name', 'ASC');
                break;
            case 'title_desc':
                $this->db->order_by('P.product_name', 'DESC');
                break;
            case 'date_asc':
                $this->db->order_by('P.date_created', 'ASC');
                break;
            case 'date_desc':
                $this->db->order_by('P.date_created', 'DESC');
                break;
            case 'price_asc':
                $this->db->order_by('P.selling_price', 'ASC');
                break;
            case 'price_desc':
                $this->db->order_by('P.selling_price', 'DESC');
                break;
            default:
                $this->db->order_by('P.product_name', 'ASC'); // Default filter
                break;
        }

        $this->db->select('P.*, W.qty, W.wishlist_id');
        $this->db->from('wishlist W');
        $this->db->join('product P', 'W.product_id = P.product_id', 'left');
        $this->db->limit($limit, $start);
        $this->db->where('P.status', 0);
        $this->db->where('P.available_stocks <= ', 0);
        $query = $this->db->get();
        return $query;
    }

    function search_items($postData) {
        $response = array();

        if(isset($postData['term'])) {
            $this->db->select('P.product_name');
            $this->db->from('wishlist W');
            $this->db->join('product P', 'W.product_id = P.product_id', 'left');
            $this->db->group_start();
                $this->db->where("P.product_name like '%". $postData['term'] . "%'");
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
}
