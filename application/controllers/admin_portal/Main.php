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
        $this->load->library('cipher');
        $this->lang->load('common','english');
        $this->load->model('admin_portal/main_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('adminIn', 'admin/login');
    } //End __construct

    public function index()
    {
        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/dashboard');
        $data['active_page'] = 'dashboard_page';
        $data['card_title'] = 'Dashboard';
        $data['icon'] = 'bi bi-speedometer2';
        $data['header_contents'] = array(
            '<link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" rel="stylesheet">',
            '<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>',
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );
	
        $this->load->view('admin_portal/partial/_header', $data);
        $this->load->view('admin_portal/dashboard', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function reseller_application()
    {
        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/dashboard');
        $data['active_page'] = 'reseller_page';
        $data['card_title'] = 'Resellers Application';
        $data['icon'] = 'bi bi-speedometer2';
        $data['header_contents'] = array(
            '<link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" rel="stylesheet">',
            '<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>',
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );
	
        $this->load->view('admin_portal/partial/_header', $data);
        $this->load->view('admin_portal/reseller_application', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function reseller_application_info()
    {
        $data['role_permissions'] = $this->role_permissions();
        $this->load->model('admin_portal/reseller_application_model', 'reseller_application');
        $application_id = $this->cipher->decrypt($this->input->get('application', true));

        $data['reseller'] = $this->reseller_application->get_row('reseller_application', array('application_id' => $application_id, 'status' => 0));
        $data['referred_by'] = $this->reseller_application->get_referred_name($data['reseller']['referral_code']);

        $data['home_url'] = base_url('admin/dashboard');
        $data['active_page'] = 'reseller_page';
        $data['card_title'] = 'Resellers Application';
        $data['icon'] = 'bi bi-speedometer2';
        $data['header_contents'] = array(
            '<link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" rel="stylesheet">',
            '<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>',
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );
	
        $this->load->view('admin_portal/partial/_header', $data);
        $this->load->view('admin_portal/reseller_application_info', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function reseller_account()
    {
        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/dashboard');
        $data['active_page'] = 'reseller_account_page';
        $data['card_title'] = 'Resellers Account';
        $data['icon'] = 'bi bi-speedometer2';
        $data['header_contents'] = array(
            '<link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" rel="stylesheet">',
            '<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>',
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );
	
        $this->load->view('admin_portal/partial/_header', $data);
        $this->load->view('admin_portal/reseller_account', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function reseller_account_info()
    {
        $data['role_permissions'] = $this->role_permissions();
        $this->load->model('admin_portal/reseller_application_model', 'reseller_application');
        $reseller_id = $this->cipher->decrypt($this->input->get('id', true));

        $data['reseller'] = $this->reseller_application->get_row('reseller_information', array('reseller_id' => $reseller_id));
        $data['referred_by'] = $this->reseller_application->get_referred_name($data['reseller']['referred_by']);
        
        $data['home_url'] = base_url('admin/dashboard');
        $data['active_page'] = 'reseller_account_page';
        $data['card_title'] = 'Resellers Information';
        $data['icon'] = 'bi bi-speedometer2';
        $data['header_contents'] = array(
            '<link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" rel="stylesheet">',
            '<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>',
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );
	
        $this->load->view('admin_portal/partial/_header', $data);
        $this->load->view('admin_portal/reseller_account_info', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function user_account()
    {
        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/dashboard');
        $data['active_page'] = 'user_account_page';
        $data['card_title'] = 'Users Account';
        $data['icon'] = 'bi bi-speedometer2';
        $data['header_contents'] = array(
            '<link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" rel="stylesheet">',
            '<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>',
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );
	
        $this->load->view('admin_portal/partial/_header', $data);
        $this->load->view('admin_portal/user_account', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function product_management()
    {
        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/dashboard');
        $data['active_page'] = 'product_page';
        $data['card_title'] = 'Product Management';
        $data['icon'] = 'bi bi-speedometer2';
        $data['header_contents'] = array(
            '<link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" rel="stylesheet">',
            '<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>',
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );
	
        $this->load->view('admin_portal/partial/_header', $data);
        $this->load->view('admin_portal/product_management', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function stock_in()
    {
        $data['role_permissions'] = $this->role_permissions();
        $this->load->model('admin_portal/inventory/product_management_model', 'product_management');
        $product_id = $this->cipher->decrypt($this->input->get('product', true));

        $data['product'] = $this->product_management->get_row('product', array('product_id' => $product_id, 'status' => 0));

        $data['home_url'] = base_url('admin/dashboard');
        $data['active_page'] = 'product_page';
        $data['card_title'] = 'Stock-In Management';
        $data['icon'] = 'bi bi-speedometer2';
        $data['header_contents'] = array(
            '<link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" rel="stylesheet">',
            '<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>',
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );
	
        $this->load->view('admin_portal/partial/_header', $data);
        $this->load->view('admin_portal/stock_in', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function account_management()
    {
        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/dashboard');
        $data['active_page'] = 'account_management_page';
        $data['card_title'] = 'Admin Staff Account';
        $data['icon'] = 'bi bi-speedometer2';
        $data['header_contents'] = array(
            '<link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" rel="stylesheet">',
            '<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>',
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );
	
        $this->load->view('admin_portal/partial/_header', $data);
        $this->load->view('admin_portal/admin_account_management', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function get_sidebar_count()
    {
        $reseller = $this->main_model->get_reseller_application();

        $application_request = $reseller;

        $output = array(
            'application_request' => $application_request,
            'reseller_request' => $reseller,
        );

        echo json_encode($output);
    }

    public function check_old_pass()
    {
        $success = '';
        $error = '';
        $old_pass = $this->input->post('old_pass', true);

        $checkPass = $this->main_model->check_old_pass($old_pass);
        if ($checkPass) {
            $success == 'Success';
        } else {
            $error = 'Please input the correct password';
        }
        $output = array(
            'success' => $success,
            'error' => $error,
        );
        echo json_encode($output);
    }

    public function update_password()
    {
        $message = '';
        $new_password = $this->input->post('password', true);

        $update_password = array(
            'password' => password_hash($new_password, PASSWORD_DEFAULT),
            'temp_password' => '',
        );
        $result = $this->main_model->update_password($update_password);
        if ($result == TRUE) {
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output['message'] = $message;
        echo json_encode($output);
    }

}