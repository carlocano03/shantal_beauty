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

class Login extends MY_Controller
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
        $this->load->model('admin_portal/main_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');

    } //End __construct

    public function index()
    {
        $this->load->view('admin_portal/login');
	}

    public function login_process()
    {
        $success = '';
        $error = '';
        $main_url = '';
        $username = trim($this->input->post('username', true));
        $password = trim($this->input->post('password', true));

        $session = $this->main_model->user_check($username, $password);
        $userCheck = $this->main_model->userCheck($username);

        if ($userCheck > 0) {
            if ($session) {
                if ($session['is_active'] == 1) {
                    $error = '<div class="alert alert-danger"><i class="fas fa-info-circle me-2"></i>Your account is deactivated.</div>';
                } elseif ($session['status'] == 1) {
                    $error = '<div class="alert alert-danger"><i class="fas fa-info-circle me-2"></i>Your account is already deleted.</div>';
                } else {
                    $user_details = $this->main_model->get_user_details($session['user_id']);

                    $sess_array = array(
                        'user_id'       => $user_details['user_id'],
                        'user_type_id'  => $session['user_type_id'],
                        'fullname'      => $user_details['first_name'] .' '. $user_details['last_name'],
                        'email_add'     => $user_details['active_email'],
                        'temp_pass'     => $session['temp_password'],
                    );
                    $this->session->set_userdata('adminIn', $sess_array);
                    $main_url = base_url('admin/dashboard');

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
        $this->session->unset_userdata($session);
        redirect('admin/login');
    }

}