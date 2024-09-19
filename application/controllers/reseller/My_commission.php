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

class My_commission extends MY_Controller
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
        $this->load->model('reseller/my_commission_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('resellerIn', 'reseller');
    } //End __construct

    public function get_reseller_count()
    {
        $my_reseller = $this->my_commission_model->get_reseller_count();

        $output = array(
            'recruited_reseller' => number_format($my_reseller),
        );
        echo json_encode($output);
    }

    public function get_recruited_reseller()
    {
        $reseller = $this->my_commission_model->get_recruited_reseller();
        $data = array();
        $no = $_POST['start'];
        foreach ($reseller as $list) {
            $no++;
            $row = array();

            $fullname = $list->last_name.', '.$list->first_name;
            $reseller_id = $this->cipher->encrypt($list->reseller_id);

            $row[] = $no;
            $row[] = $list->reseller_no;
            $row[] = ucwords($fullname);
            $row[] = $list->email_address;
            $row[] = date('D M j, Y h:i A', strtotime($list->date_created));
            $row[] = $list->referral_code;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->my_commission_model->count_all_reseller(),
            "recordsFiltered" => $this->my_commission_model->count_filtered_reseller(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

}