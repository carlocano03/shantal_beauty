<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */
class Event_management_model extends MY_Model
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

	function insert_event($data)
    {
      return $this->db->insert('events',$data);
    }

	public function get_all_events($status = null){
		$this->db->select('*');
		$this->db->from('events');

		if($status !== null){
			$this->db->where('is_active',$status);
		}

		$query = $this->db->get();
		return $query->result_array();

	}

	public function update_status($event_id,$data){
		$this->db->where('event_id',$event_id);
		return $this->db->update('events',$data);
	}

	public function get_active_events(){
		$this->db->select('*');
		$this->db->from('events');
		$this->db->where('is_active',1);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function update_event_status() {
        $current_datetime = date('Y-m-d H:i:s');

        $this->db->set('status', 'finished')
                 ->where('status', 'upcoming')
                 ->where("CONCAT(event_date, ' ', end_time) <", $current_datetime)
                 ->update('events');
    }

	public function get_finished_events() {
		$this->db->select('*');
		$this->db->from('events');
        $this->db->where('status', 'finished');
        $query = $this->db->get();
        return $query->result();
    }

	public function delete_event_by_id($id) {
   		$this->db->where('id', $id);
    	return $this->db->delete('events');
    }

	public function get_closest_upcoming_event_date() {
		$this->db->select('event_date');
		$this->db->from('events');
		$this->db->where('start_time > NOW()'); 
		$this->db->order_by('start_time', 'ASC'); 
		$this->db->limit(1); 
		
		$query = $this->db->get();
		$result = $query->row_array(); 
		

		return isset($result['event_date']) ? $result['event_date'] : null;
	}


 
}