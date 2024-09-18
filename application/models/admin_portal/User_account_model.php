<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class User_account_model extends MY_Model
{
    var $user = 'user_acct';
    var $user_order = array('UD.full_name', 'UD.email_address', 'UD.date_created', 'UA.is_active');
    var $user_search = array('UD.full_name', 'UD.email_address', 'UD.date_created', 'UA.is_active');
    var $order_user = array('UD.user_details_id' => 'ASC'); // default order

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

    public function get_account_list()
    {
        $this->_get_account_list_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
	

    public function count_filtered()
    {
        $this->_get_account_list_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select('UA.*, UD.full_name, UD.email_address, UD.email_verification, UD.date_created');
        $this->db->from($this->user.' UA');
        $this->db->join('user_details UD', 'UA.user_id = UD.user_id', 'left');
        $this->db->where('UA.user_type_id', CUSTOMER);
        $this->db->where('UA.status', 0);
        return $this->db->count_all_results();
    }

    private function _get_account_list_query()
    {
        $this->db->select('UA.*, UD.full_name, UD.email_address, UD.email_verification, UD.date_created');
        $this->db->from($this->user.' UA');
        $this->db->join('user_details UD', 'UA.user_id = UD.user_id', 'left');
        $this->db->where('UA.user_type_id', CUSTOMER);
        $this->db->where('UA.status', 0);
        $i = 0;
        foreach ($this->user_search as $item) // loop column 
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

                if (count($this->user_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->user_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_user)) {
            $order = $this->order_user;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function update_account($update_account, $user_id)
    {
        $this->db->where('user_id', $user_id);
        $update = $this->db->update('user_acct', $update_account);
        return $update ? TRUE : FALSE;
    }

    function delete_account($delete_account, $user_id)
    {
        $this->db->where('user_id', $user_id);
        $delete = $this->db->update('user_acct', $delete_account);
        return $delete ? TRUE : FALSE;
    }

}