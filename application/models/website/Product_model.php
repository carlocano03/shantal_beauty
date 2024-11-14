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

    function get_product_count($search_query)
    {
        if (!empty($search_query)) {
            $this->db->like('product_name', $search_query);
        }
        $this->db->where('status', 0);
        return $this->db->count_all('product');
    }

    function get_product_list($limit, $start, $search_query)
    {
        if (!empty($search_query)) {
            $this->db->like('product_name', $search_query);
        }
        $this->db->limit($limit, $start);
        $this->db->where('status', 0);
        $query = $this->db->get('product');
        return $query;
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

    function get_product_details($product_id)
    {
        $this->db->where('product_id', $product_id);
        $this->db->where('status', 0);
        $query = $this->db->get('product');
        return $query;
    }

}