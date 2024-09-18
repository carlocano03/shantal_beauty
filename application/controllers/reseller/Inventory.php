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

class Inventory extends MY_Controller
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
        $this->load->model('reseller/inventory_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('resellerIn', 'reseller');
    } //End __construct

    public function product_list()
    {
        $lot_number = $this->inventory_model->product_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($lot_number as $list) {
            $no++;
            $row = array();

            $product_id = $this->cipher->encrypt($list->product_id);

            $row[] = $no;
            $row[] = ucwords($list->product_name);
            $row[] = $list->net_weight;
            $row[] = number_format($list->selling_price,2);
            $row[] = number_format($list->available_stocks);
            
            if ($list->available_stocks > 0) {
                $status = '<span class="badge bg-success">With Stocks</span>';
            } else {
                $status = '<span class="badge bg-danger">No Stocks</span>';
            }

            $row[] = $status;
            $action = '
                <div class="btn-group">
                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu" style="">
                        <li><a href="'.base_url('reseller/inventory/product-information?id='.$product_id).'" class="dropdown-item link-cursor text-primary"><i class="bi bi-view-list me-2"></i>View Product</a></li>
                    </ul>
                </div>
            ';

            $row[] = $action;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->inventory_model->count_all(),
            "recordsFiltered" => $this->inventory_model->count_filtered(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

    public function get_lot_number()
    {
        $lot_number = $this->inventory_model->get_lot_number();
        $data = array();
        $no = $_POST['start'];
        foreach ($lot_number as $list) {
            $no++;
            $row = array();

            $row[] = $no;
            $row[] = $list->batch_lot_no;
            $row[] = date('F j, Y', strtotime($list->expiration_date));
            $row[] = number_format($list->stocks);

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->inventory_model->count_all_lot(),
            "recordsFiltered" => $this->inventory_model->count_filtered_lot(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

}