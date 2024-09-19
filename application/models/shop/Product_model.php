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

    function get_product_count()
    {
        $this->db->where('status', 0);
        return $this->db->count_all('product');
    }

    function get_product_list($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->where('status', 0);
        $query = $this->db->get('product');
        return $query;
    }

}