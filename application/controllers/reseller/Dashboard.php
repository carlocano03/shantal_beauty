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

class Dashboard extends MY_Controller
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
        $this->load->model('reseller/main_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('resellerIn', 'reseller');
    } //End __construct

    public function index()
    {
        $data['home_url'] = base_url('reseller/dashboard');
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
	
        $this->load->view('reseller_portal/partial/_header', $data);
        $this->load->view('reseller_portal/dashboard', $data);
        $this->load->view('reseller_portal/partial/_footer', $data);
    }

    public function inventory()
    {
        $data['home_url'] = base_url('reseller/dashboard');
        $data['active_page'] = 'inventory_page';
        $data['card_title'] = 'Inventory Management';
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
	
        $this->load->view('reseller_portal/partial/_header', $data);
        $this->load->view('reseller_portal/inventory', $data);
        $this->load->view('reseller_portal/partial/_footer', $data);
    }

    public function product_information()
    {
        $this->load->model('reseller/inventory_model');
        $product_id = $this->cipher->decrypt($this->input->get('id', true));

        $data['product'] = $this->inventory_model->get_row('product', array('product_id' => $product_id, 'status' => 0));
        $data['home_url'] = base_url('reseller/dashboard');
        $data['active_page'] = 'inventory_page';
        $data['card_title'] = 'Inventory Management';
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
	
        $this->load->view('reseller_portal/partial/_header', $data);
        $this->load->view('reseller_portal/product_information', $data);
        $this->load->view('reseller_portal/partial/_footer', $data);
    }

    public function voucher_creation()
    {
        $this->load->model('reseller/voucher_model');
        $data['product'] = $this->voucher_model->get_result('product', array('status' => 0));
        
        $data['home_url'] = base_url('reseller/dashboard');
        $data['active_page'] = 'voucher_page';
        $data['card_title'] = 'Voucher Creation';
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
	
        $this->load->view('reseller_portal/partial/_header', $data);
        $this->load->view('reseller_portal/voucher_creation', $data);
        $this->load->view('reseller_portal/partial/_footer', $data);
    }

    public function my_commission()
    {
        $data['home_url'] = base_url('reseller/dashboard');
        $data['active_page'] = 'commission_page';
        $data['card_title'] = 'My Commission';
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
	
        $this->load->view('reseller_portal/partial/_header', $data);
        $this->load->view('reseller_portal/my_commission', $data);
        $this->load->view('reseller_portal/partial/_footer', $data);
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