<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class News_management_model extends MY_Model
{
    var $news = 'news';
    var $news_order = array('N.news_title', 'AU.first_name', 'AU.last_name', 'N.date_created');
    var $news_search = array('N.news_title', 'AU.first_name', 'AU.last_name', 'N.date_created');
    var $order_news = array('N.news_id' => 'DESC'); // default order

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

    function check_existing_news($news_title)
    {
        $this->db->where('news_title', $news_title);
        $this->db->where('status', 0);
        $query = $this->db->get('news');
        return $query->num_rows();
    }

    function insert_news($insert_news)
    {
        $insert = $this->db->insert('news', $insert_news);
        return $insert ? TRUE : FALSE;
    }

    public function get_news_list()
    {
        $this->_get_news_list_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
	

    public function count_filtered()
    {
        $this->_get_news_list_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select('N.*');
        $this->db->select("CONCAT(AU.last_name, ', ',AU.first_name) as posted_by");
        $this->db->from($this->news.' N');
        $this->db->join('admin_user_details AU', 'N.user_id = AU.user_id', 'left');
        return $this->db->count_all_results();
    }

    private function _get_news_list_query()
    {
        $this->db->select('N.*');
        $this->db->select("CONCAT(AU.last_name, ', ',AU.first_name) as posted_by");
        $this->db->from($this->news.' N');
        $this->db->join('admin_user_details AU', 'N.user_id = AU.user_id', 'left');
        $i = 0;
        foreach ($this->news_search as $item) // loop column 
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

                if (count($this->news_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->news_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_news)) {
            $order = $this->order_news;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}