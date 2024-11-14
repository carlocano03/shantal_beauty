<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class News_model extends MY_Model
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

    function get_latest_news()
    {
        $this->db->where('status', 0);
        $this->db->order_by('news_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('news');
        return $query->row();
    }

    function get_news_count()
    {
        $this->db->where('status', 0);
        return $this->db->count_all('news');
    }

    function get_news_list($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->where('status', 0);
        $query = $this->db->get('news');
        return $query;
    }

    function get_news_details($news_id)
    {
        $this->db->select('N.*');
        $this->db->select("CONCAT(AU.first_name, ' ',AU.last_name) as author");
        $this->db->from('news N');
        $this->db->join('admin_user_details AU', 'N.user_id = AU.user_id', 'left');
        $this->db->where('N.news_id', $news_id);
        $this->db->where('N.status', 0);
        $query = $this->db->get();
        return $query->row();
    }

    function get_featured_product()
    {
        $this->db->where('status', 0);
        $this->db->order_by('product_id', 'DESC');
        $this->db->limit(2);
        $query = $this->db->get('product');
        return $query->result();
    }


}