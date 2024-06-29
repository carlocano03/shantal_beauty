<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class System_counter_generator_model extends MY_Model
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

    function get_ctrl_num_details($id) {
        $this->db->select('*');
        $this->db->from('counter_management');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

    function get_ctrl_num($id) {
        $this->db->select('*');
        $this->db->from('counter_management');
        $this->db->where('id', $id);
        $result = $this->db->get()->row_array();

        if (!$result) {
            return FALSE;
        } else {
            $system_code = $result['system_code'];
            $counter = $result['counter'];
            $counter_padded = sprintf("%05d", $counter);
            $ctrl_no = $system_code . '-' . $counter_padded;

            return $ctrl_no;
        }
    }

    function increment_ctrl_num($id) {

        $this->db->trans_begin();
        $this->db->set('counter', 'counter+1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('counter_management');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $this->db->trans_commit();
        return true;
    }

    function get_ctrl_num_cv($id) {
        $this->db->select('*');
        $this->db->from('counter_management');
        $this->db->where('id', $id);
        
        $result = $this->db->get()->row_array();
        
        if (!$result) {
            return FALSE;
        } else {
            $system_code = $result['system_code'];
            $counter = $result['counter'];
            $year = date('y');
            $month = date('m');
            $counter_padded = sprintf("%05d", $counter);
            $ctrl_no = $system_code . $year.$month .'-' . $counter_padded;

            return $ctrl_no;
        }
    }
}