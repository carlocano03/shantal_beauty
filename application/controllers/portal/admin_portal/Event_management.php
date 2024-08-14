<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 *
 * @version 1.0
 * @author Carlo Cano <carlocano03@gmail.com>
 * @copyright Copyright &copy; 2023,
 *
 */

class Event_management extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('language');
        $this->lang->load('common','english');
        $this->load->library('cipher');
		$this->load->model('portal/admin_portal/event_management_model');
		$this->event_management_model->update_event_status();
        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('adminIn', 'login');
    } //End __construct

    public function index()
    {
        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/portal');
        $data['active_page'] = 'event_management_page';
        $data['card_title'] = 'Event Management';
        $data['icon'] = 'bi bi-person-fill-gear';
        $data['header_contents'] = array(
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );
		$data['active_events'] = $this->event_management_model->get_active_events();
	

        $this->load->view('admin_portal/partial/_header', $data);
        $this->load->view('admin_portal/event_management', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

	private function upload_img()
    {
        if (isset($_FILES["event_img"]))
        {
            $dt = Date('His');
            $extension = explode('.', $_FILES['event_img']['name']);
            $new_name = rand() . '_' . $dt . '.' . $extension[1];
            $destination = 'assets/uploaded_attachment/events/' . $new_name;
            move_uploaded_file($_FILES['event_img']['tmp_name'], $destination);
            return $new_name;
        } 
    }

	public function add_event(){
		
		$event_name = $this->input->post('event_name');
		$event_date = $this->input->post('event_date');
		$start_time = $this->input->post('start_time');
		$end_time = $this->input->post("end_time");
		$event_location = $this->input->post("event_location");
		$event_description = $this->input->post("event_description");

		$upload_img = $this->upload_img();

		if ($upload_img === false) {
			$response = array('status' => 'error', 'message' => 'Image upload failed.');
			echo json_encode($response);
			return;
		}

		$data = array(
			"event_name" => $event_name,
			"event_date" => $event_date,
			"start_time" => $start_time,
			"end_time" => $end_time,
			"event_description" =>$event_description,
			"event_img" => $upload_img,
			"event_location" =>$event_location
		);

		$status = $this->event_management_model->insert_event($data);

		if($status){
			$response = array(
				'status'=>'success','message' => 'Event added successfully.'
			);
		}else{
			$response = array('status'=>'error', 'message' => 'Failed to add event.');
		}

		echo json_encode($response);

	}

	
	public function update_event_status($event_id){
		$data = array("is_active" => $is_active);

		$status = $this->event_management_model->update_status($event_id,$data);

		if($status){
			$response = array('status' => 'success', 'message' => 'Event status updated.');
		}else{
			$response = array('status' => 'error', 'message' => 'Failed to update status.');
		}

		echo json_encode($response);
	}

	public function fetch_finished_events() {
		$finished_events = $this->event_management_model->get_finished_events();
		echo json_encode($finished_events);
	}

	public function delete_event(){
		$id = $this->input->post('id'); 
		$status = $this->event_management_model->delete_event_by_id($id);

		if($status){
			$response = array('status' => 'success', 'message' => 'Event Deleted.');
		}else{
			$response = array('status' => 'error', 'message' => 'Failed to Delete status.');
		}
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
	}

	public function get_active_events() {
		$data['active_events'] = $this->event_management_model->get_active_events();
		$response = array(
			'status' => 'success',
			'events' => $data['active_events']
		);
		echo json_encode($response);
	}
	
	
}