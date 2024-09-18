<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class Voucher_model extends MY_Model
{
    var $voucher = 'voucher';
    var $voucher_order = array('V.vocuher_code','V.description','V.date_created','V.end_date','V.request_status','P.product_name');
    var $voucher_search = array('V.vocuher_code','V.description','V.date_created','V.end_date','V.request_status','P.product_name'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order = array('V.voucher_id' => 'ASC'); // default order
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

    function check_voucher($product_id, $reseller_id)
    {
        $this->db->where('product_id', $product_id);
        $this->db->where('reseller_id', $reseller_id);
        $this->db->where('status', 0);
        $query = $this->db->get('voucher');
        return $query;
    }

    function insert_voucher($insert_voucher)
    {
        $insert = $this->db->insert('voucher', $insert_voucher);
        return $insert?TRUE:FALSE;
    }

    public function get_voucher_list()
    {
        $this->_get_voucher_list_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_voucher_list_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select('V.*, P.product_name');
        $this->db->from($this->voucher.' V');
        $this->db->join('product P', 'V.product_id = P.product_id', 'left');
        $this->db->where('V.reseller_id', $this->session->userdata('resellerIn')['reseller_id']);
        $this->db->where('V.is_deleted IS NULL');
        return $this->db->count_all_results();
    }

    private function _get_voucher_list_query()
    {
        $this->db->select('V.*, P.product_name');
        $this->db->from($this->voucher.' V');
        $this->db->join('product P', 'V.product_id = P.product_id', 'left');
        $this->db->where('V.reseller_id', $this->session->userdata('resellerIn')['reseller_id']);
        $this->db->where('V.is_deleted IS NULL');
        $i = 0;
        foreach ($this->voucher_search as $item) // loop column 
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

                if (count($this->voucher_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->voucher_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function update_voucher($update_voucher, $voucher_id)
    {
        $this->db->where('voucher_id', $voucher_id);
        $update = $this->db->update('voucher', $update_voucher);
        return $update?TRUE:FALSE;
    }
}