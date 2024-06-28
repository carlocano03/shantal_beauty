<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2022,
 *
 */
class Main_model extends MY_Model
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
        // $this->load->database();
    }

    function get_auto_reply_info()
    {
        $query = $this->db->get('autoreply_credentials');
        return $query->row_array();
    }
}