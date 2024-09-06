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

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        // $this->check_session('adminIn', 'login');
    } //End __construct

    public function index()
    {
        //$data['role_permissions'] = $this->role_permissions();
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
        //$data['role_permissions'] = $this->role_permissions();
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

    public function reseller_account()
    {
        //$data['role_permissions'] = $this->role_permissions();
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

    public function user_account()
    {
        //$data['role_permissions'] = $this->role_permissions();
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
        //$data['role_permissions'] = $this->role_permissions();
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

}