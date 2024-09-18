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

class Voucher extends MY_Controller
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
        $this->load->model('reseller/voucher_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('resellerIn', 'reseller');
    } //End __construct

    public function add_new_voucher()
    {
        $success = '';
        $error = '';
        $product_id = $this->input->post('product_id', true);
        $voucher_code = $this->input->post('voucher_code', true);
        $vocher_desc = $this->input->post('vocher_desc', true);
        $voucher_amt = $this->input->post('voucher_amt', true);
        $end_date = $this->input->post('end_date', true);
        $reseller_id = $this->session->userdata('resellerIn')['reseller_id'];

        $check_voucher = $this->voucher_model->check_voucher($product_id, $reseller_id);
        if ($check_voucher->num_rows() > 0) {
            $error = 'Voucher for this product is already exist';
        } else {
            $insert_voucher = array(
                'voucher_code'      => $voucher_code,
                'product_id'        => $product_id,
                'reseller_id'       => $reseller_id,
                'description'       => $vocher_desc,
                'voucher_amt'       => str_replace(',','',$voucher_amt),
                'end_date'          => $end_date,
                'request_status'    => 'For Approval',
                'date_created'      => date('Y-m-d H:i:s'),
            );
            $result = $this->voucher_model->insert_voucher($insert_voucher);
            if ($result == TRUE) {
                $success = 'Voucher uccessfully submitted.';
            } else {
                $error = 'Failed to submit the voucher.';
            }
        }
        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }

    public function voucher_list()
    {
        $voucher = $this->voucher_model->get_voucher_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($voucher as $list) {
            $no++;
            $row = array();

            $row[] = $no;
            $row[] = '<div>'.$list->voucher_code.'</div>
                      <span style="font-size:10px; color:red; font-weight:600;">Product: '.ucwords($list->product_name).'</span>';
            $row[] = $list->description;
            $row[] = date('D M j, Y h:i A', strtotime($list->date_created));
            $row[] = date('F j, Y', strtotime($list->end_date));

            $stageColors = array(
                'For Approval' => 'bg-warning',
                'Approved' => 'bg-success',
                'Declined' => 'bg-danger',
            );
            $color = array_key_exists($list->request_status, $stageColors) ? $stageColors[$list->request_status] : 'bg-secondary';
            $row[] = '<div class="badge '.$color.'">'.$list->request_status.'</div>';

            if ($list->request_status != 'For Approval') {
                $disabled = 'disabled';
            } else {
                $disabled = '';
            }
            $action_btn = '<div class="btn-group">
                            <button '.$disabled.' type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item link-cursor text-primary update_modal"
                                    data-id="'.$list->voucher_id.'"
                                    data-product="'.$list->product_id.'"
                                    data-voucher_code="'.$list->voucher_code.'"
                                    data-desc="'.$list->description.'"
                                    data-amt="'.$list->voucher_amt.'"
                                    data-end_date="'.$list->end_date.'"
                                ><i class="bi bi-pencil-square me-2"></i>Update Voucher</a></li>
                                <li><a class="dropdown-item link-cursor text-danger delete_voucher" data-id="'.$list->voucher_id.'"><i class="bi bi-trash3-fill me-2"></i>Delete Voucher</a></li>
                            </ul>
                        </div>';

            $row[] = $action_btn;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->voucher_model->count_all(),
            "recordsFiltered" => $this->voucher_model->count_filtered(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

    public function update_voucher()
    {
        $success = '';
        $error = '';
        $voucher_id = $this->input->post('voucher_id', true);
        $product_id = $this->input->post('product_id', true);
        $voucher_code = $this->input->post('voucher_code', true);
        $vocher_desc = $this->input->post('vocher_desc', true);
        $voucher_amt = $this->input->post('voucher_amt', true);
        $end_date = $this->input->post('end_date', true);

        $update_voucher = array(
            'voucher_code'      => $voucher_code,
            'product_id'        => $product_id,
            'description'       => $vocher_desc,
            'voucher_amt'       => str_replace(',','',$voucher_amt),
            'end_date'          => $end_date,
        );
        $result = $this->voucher_model->update_voucher($update_voucher, $voucher_id);
        if ($result == TRUE) {
            $success = 'Voucher successfully updated.';
        } else {
            $error = 'Failed to update the voucher.';
        }
        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }

    public function delete_voucher()
    {
        $success = '';
        $error = '';
        $voucher_id = $this->input->post('voucher_id', true);

        $update_voucher = array(
            'is_deleted'    => 'YES',
            'date_deleted'  => date('Y-m-d H:i:s'),
        );
        $result = $this->voucher_model->update_voucher($update_voucher, $voucher_id);
        if ($result == TRUE) {
            $success = 'Voucher successfully deleted.';
        } else {
            $error = 'Failed to delete the voucher.';
        }
        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }

}