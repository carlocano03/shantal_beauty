<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class Reseller_application_model extends MY_Model
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

    function save_application($insert_application)
    {
        $insert = $this->db->insert('reseller_application', $insert_application);
        return $insert?TRUE:FALSE;
    }

    function check_existing($referenceNumber)
    {
        $this->db->where('application_no', $referenceNumber);
        $query = $this->db->get('reseller_application');
        return $query;
    }

}