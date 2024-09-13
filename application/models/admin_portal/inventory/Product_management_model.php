<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class Product_management_model extends MY_Model
{
    var $lot_number = 'product_stocks';
    var $lot_number_order = array('batch_lot_no', 'expiration_date', 'stocks');
    var $lot_number_search = array('batch_lot_no', 'expiration_date', 'stocks'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order_lot_number = array('expiration_date' => 'ASC'); // default order

    var $product = 'product';
    var $product_order = array('product_name', 'net_weight', 'selling_price', 'available_stocks');
    var $product_search = array('product_name', 'net_weight', 'selling_price', 'available_stocks'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order_product = array('product_id' => 'DESC'); // default order
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

    function check_existing_product($product_name)
    {
        $this->db->where('product_name', $product_name);
        $query = $this->db->get('product');
        return $query;
    }

    function insert_new_product($insert_product)
    {
        $insert = $this->db->insert('product', $insert_product);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return '';
        }
    }

    function update_product($update_product, $product_id)
    {
        $this->db->where('product_id', $product_id);
        $update = $this->db->update('product', $update_product);
        return $update?TRUE:FALSE;
    }

    public function get_lot_number()
    {
        $this->_get_lot_number_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_lot()
    {
        $this->_get_lot_number_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_lot()
    {
        $this->db->from($this->lot_number);
        $this->db->where('status', 0);
        $this->db->where('product_id', $this->input->post('product', true));
        return $this->db->count_all_results();
    }

    private function _get_lot_number_query()
    {
        $this->db->from($this->lot_number);
        $this->db->where('status', 0);
        $this->db->where('product_id', $this->input->post('product', true));

        $i = 0;
        foreach ($this->lot_number_search as $item) // loop column 
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

                if (count($this->lot_number_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->lot_number_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_lot_number)) {
            $order = $this->order_lot_number;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function add_stocks($insert_stocks)
    {
        $insert = $this->db->insert('product_stocks', $insert_stocks);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return '';
        }
    }

    function increment_stocks($product_id, $qty_in)
    {
        $this->db->set('available_stocks', 'available_stocks + ' . (int) $qty_in, FALSE);
        $this->db->where('product_id', $product_id);
        return $this->db->update('product');
    }

    function decrement_stocks($product_id, $stock)
    {
        $this->db->set('available_stocks', 'available_stocks - ' . (int) $stock, FALSE);
        $this->db->where('product_id', $product_id);
        return $this->db->update('product');
    }

    function insert_history($insert_stock_history)
    {
        $this->db->insert('product_stock_in_history', $insert_stock_history);
    }

    function check_existing_lot($product_id, $lot_number)
    {
        $this->db->where('product_id', $product_id);
        $this->db->where('batch_lot_no', $lot_number);
        $this->db->where('status', 0);
        $query = $this->db->get('product_stocks');
        return $query;
    }

    function update_stocks($update_stock, $stock_id)
    {
        $this->db->where('stock_id', $stock_id);
        $update = $this->db->update('product_stocks', $update_stock);
        return $update?TRUE:FALSE;
    }

    public function product_list()
    {
        $this->_product_list_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_product_list_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->product);
        $this->db->where('status', 0);
        if ($this->input->post('stock')) {
            if ($this->input->post('stock') == 'With Stocks') {
                $this->db->where('available_stocks >', 0);
            } else {
                $this->db->where('available_stocks', 0);
            }
        }
        return $this->db->count_all_results();
    }

    private function _product_list_query()
    {
        $this->db->from($this->product);
        $this->db->where('status', 0);
        if ($this->input->post('stock')) {
            if ($this->input->post('stock') == 'With Stocks') {
                $this->db->where('available_stocks >', 0);
            } else {
                $this->db->where('available_stocks', 0);
            }
        }
        $i = 0;
        foreach ($this->product_search as $item) // loop column 
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

                if (count($this->product_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->product_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_product)) {
            $order = $this->order_product;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function delete_product($delete_product, $product_id)
    {
        $this->db->where('product_id', $product_id);
        $delete = $this->db->update('product', $delete_product);
        return $delete?TRUE:FALSE;
    }

}