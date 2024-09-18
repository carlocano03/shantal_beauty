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

class User_account extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('language');
        $this->load->library('cipher');
        $this->lang->load('common','english');
        $this->load->model('admin_portal/user_account_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('adminIn', 'admin/login');
    } //End __construct

    public function get_user_account()
    {
        $account = $this->user_account_model->get_account_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($account as $list) {
            $no++;
            $row = array();

            $row[] = $no;
            $row[] = ucwords($list->full_name);
            $row[] = $list->email_address;
            $row[] = date('D M j, Y h:i A', strtotime($list->date_created));

            $color_mapping = [
                'Fror Verification' => 'bg-warning',
                'Verified' => 'bg-success',
            ];
            $badge_color = isset($color_mapping[$list->email_verification]) ? $color_mapping[$list->email_verification] : 'bg-warning';
            $row[] = '<div class="badge ' . $badge_color . ' px-3">' . $list->email_verification . '</div>';

            if ($list->is_active == 1) {
                $row[] = '<label class="switch">
							  <input type="checkbox" class="account_activation" id="' . $list->user_id . '">
							  <span class="slider round"></span>
					  	  </label><br>Not Active';
            } else {
                $row[] = '<label class="switch">
							  <input type="checkbox" class="account_activation" id="' . $list->user_id . '" checked>
							  <span class="slider round"></span>
					  	  </label><br>Active';
            }

            $row[] = '<button class="btn btn-danger btn-sm delete_account" data-user_id="'.$list->user_id.'"><i class="bi bi-trash3-fill me-1"></i>Delete</button>';

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user_account_model->count_all(),
            "recordsFiltered" => $this->user_account_model->count_filtered(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

    public function account_activation()
    {
        $message = '';
        $action = $this->input->post('action', true);
        $user_id = $this->input->post('user_id', true);

        if ($action == 'Activate') {
            $update_account = array(
                'is_active' => 0,//Active
            ); 
        } else {
            $update_account = array(
                'is_active' => 1,//Deactivate
            ); 
        }
        $result = $this->user_account_model->update_account($update_account, $user_id);
        if ($result == TRUE) {
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output['message'] = $message;
        echo json_encode($output);
    }

    public function delete_account()
    {
        $message = '';
        $user_id = $this->input->post('user_id', true);

        $delete_account = array(
            'status' => 1,//Deleted
        ); 

        $result = $this->user_account_model->delete_account($delete_account, $user_id);
        if ($result == TRUE) {
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output['message'] = $message;
        echo json_encode($output);
    }

}