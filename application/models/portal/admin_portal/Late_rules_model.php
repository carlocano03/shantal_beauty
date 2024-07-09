<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class Late_rules_model extends MY_Model
{
    var $rule = 'late_rules';
    var $rule_order = array('rule_name', 'no_late', 'no_days', 'date_created', 'status');
    var $rule_search = array('rule_name', 'no_late', 'no_days', 'date_created', 'status'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order = array('late_rule_id ' => 'ASC'); // default order
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

    function check_existing_rules($rule_name)
    {
        $this->db->where('rule_name', $rule_name);
        $this->db->where('status !=', 2);//Deleted
        $query = $this->db->get('late_rules');
        return $query;
    }

    function save_new_rule($insert_rule)
    {
        $insert = $this->db->insert('late_rules', $insert_rule);
        return $insert?TRUE:FALSE;
    }

    public function get_rule_list()
    {
        $this->_get_rule_list_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_rule_list_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->rule);
        $this->db->where('status !=', 2);//Deleted
        return $this->db->count_all_results();
    }

    private function _get_rule_list_query()
    {
        $this->db->from($this->rule);
        $this->db->where('status !=', 2);//Deleted
        $i = 0;
        foreach ($this->rule_search as $item) // loop column 
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

                if (count($this->rule_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->rule_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function update_late_rule($update_rule, $late_rule_id)
    {
        $this->db->where('late_rule_id', $late_rule_id);
        $update = $this->db->update('late_rules', $update_rule);
        return $update?TRUE:FALSE;
    }

}