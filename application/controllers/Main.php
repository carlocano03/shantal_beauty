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

class Main extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('language');
        $this->lang->load('common','english');
        $this->load->model('main_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
    } //End __construct

    public function index()
    {
        $data['title'] = 'Change Life Christian Church';

        $this->load->view('website/partial/_header', $data);
        $this->load->view('website/home', $data);
        $this->load->view('website/partial/_footer', $data);
    }
	
	public function login()
    {
		$data['title'] = 'Login'; 
        $this->load->view('auth/partial/_header', $data);
        $this->load->view('auth/login', $data);
    }

    // Error 404 redirect
	public function page404()
	{
		$this->load->view('error404');
	}

    public function csrf()
    {
        $data["csrf_hash"] = $this->security->get_csrf_hash(TRUE); // Set $regenerate to TRUE to generate a new hash
        echo json_encode($data);
    }

    public function login_process()
    {
        $success = '';
        $error = '';
        $main_url = '';
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $session = $this->main_model->user_check($username, $password);
        $userCheck = $this->main_model->userCheck($username);
        
        if ($userCheck > 0) {
            if ($session) {
                if ($session['is_active'] == 1) {
                    $error = '<div class="alert alert-danger p-2 text-dark">Your account is deactivated.</div>';
                } elseif ($session['status'] == 1) {
                    $error = '<div class="alert alert-danger p-2 text-dark">Your account is already deleted.</div>';
                } else {
                    $user_details = $this->main_model->get_user_details($session['user_id'], $session['user_type_id']);
                    
                    if ($session['user_type_id'] == ADMINISTRATOR || $session['user_type_id'] == ADMIN_STAFF) {
                        $sess_array = array(
                            'user_id'   => $user_details['user_id'],
                            'fullname'  => $user_details['first_name'] .' '. $user_details['last_name'],
                            'email_add' => $user_details['active_email'],
                        );
                        $this->session->set_userdata('adminIn', $sess_array);

                        $main_url = base_url('admin/dashboard');
                    } else {
                        //Scholars Member
                        $sess_array = array(
                            'user_id'           => $user_details['user_id'],
                            'scholarship_no'    => $user_details['scholarship_no'],
                            'school_name'       => $user_details['school_name'],
                            'fullname'          => $user_details['student_first_name'] .' '. $user_details['student_last_name'],
                            'email_add'         => $user_details['active_email'],
                        );
                        $this->session->set_userdata('scholarIn', $sess_array);

                        $main_url = base_url('student/dashboard');
                    }
                    $success = '<div class="alert alert-success"><i class="fas fa-info-circle me-2"></i>Please wait redirecting...</div>';
                }
            } else {
                $error = '<div class="alert alert-danger"><i class="fas fa-info-circle me-2"></i>Invalid password!</div>';
            }
        } else {
            $error = '<div class="alert alert-danger"><i class="fas fa-info-circle me-2"></i>Invalid username/email!</div>';
        }

        $output = array(
            'success' => $success,
            'error' => $error,
            'main_url' => $main_url,
        );
        echo json_encode($output);
    }

    public function logout($session)
    {
        $this->session->unset_userdata($session); // Unset the adminIn session variable
        redirect('login'); // Redirect to the 'user' controller or route
    }

}
//End CI_Controller