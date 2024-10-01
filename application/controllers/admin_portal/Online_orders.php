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

class Online_orders extends MY_Controller
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
        $this->load->model('admin_portal/online_order_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('adminIn', 'admin/login');
    } //End __construct

    public function get_orders()
    {
        $orders = $this->online_order_model->get_pending_orders();
        $data = array();
        $no = $_POST['start'];
        foreach ($orders as $list) {
            $no++;
            $row = array();

            $order_id = $this->cipher->encrypt($list->order_id);
            $row[] = $no;
            $row[] = '<a href="'.base_url('admin/order-details?order='.$order_id).'">'.$list->order_no.'</a>';
            $row[] = $list->no_items;
            $row[] = $list->referral_code;
            $row[] = date('D M j, Y h:i A', strtotime($list->date_created));

            $stageColors = array(
                'Preparing' => 'bg-warning',
                'Completed' => 'bg-success',
                'Cancelled' => 'bg-danger',
            );
            $color = array_key_exists($list->order_status, $stageColors) ? $stageColors[$list->order_status] : 'bg-secondary';

            $row[] = '<div class="badge '.$color.'">'.$list->order_status.'</div>';
            $row[] = number_format($list->total_amount,2);

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->online_order_model->count_all_pending(),
            "recordsFiltered" => $this->online_order_model->count_filtered_pending(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

    public function get_delivery_address()
    {
        $output = '';
        $shipping_id = $this->input->get('shipping_id', true);

        $address = $this->online_order_model->get_delivery_address($shipping_id);
        if ($address) {
            $complete_address = $address->street_name.' '.ucwords($address->barangay).', '.ucwords($address->municipality).', '.ucwords($address->province).' '.$address->postal_code;
            $contact_no = $this->formatPhoneNumber($address->contact_no);
            $output = '
                <div class="address_list__container">
                    <div class="ms-2 pt-2 fw-bold"><i class="bi bi-truck me-2"></i>Delivery Address</div>
                    <hr class="mt-1 mb-1">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-check checkbox d-flex align-items-center">
                            <label class="form-check-label" style="font-size:14px; font-weight:500; margin-top:4px;">
                                <span class="fw-bold">'.ucwords($address->fullname).'</span> | '.$contact_no.'
                            </label>
                        </div>
                                    
                    </div>
                    <div style="margin-left:25px; font-size:13px; color:#636e72;">
                        <div>Landmark: '.$address->landmark.'</div>
                        <div>'.$complete_address.'</div>
                    </div>
                </div>
            ';
        } else {
            $output = '<div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>No delivery address found.</div>';
        }
        $data['address_list'] = $output;
        echo json_encode($data);
    }

    private function formatPhoneNumber($mobileNumber) {
        // Remove leading zero and replace it with +63
        if (substr($mobileNumber, 0, 1) == '0') {
            $mobileNumber = '+63' . substr($mobileNumber, 1);
        }
    
        // Format the number with spaces
        $formattedNumber = preg_replace('/(\+63)(\d{3})(\d{3})(\d{4})/', '($1) $2 $3 $4', $mobileNumber);
    
        return $formattedNumber;
    }

    public function prepare_order()
    {
        $success = '';
        $error = '';
        $commission_amt = 0;
        $order_id = $this->input->post('order_id', true);
        $order_data = $this->input->post('order_data', true);
        $referral_code = $this->input->post('referral_code', true);
        $subtotal = $this->input->post('subtotal', true);

        $update_order = array(
            'order_status' => 'Preparing',
        );
        $result = $this->online_order_model->update_order_status($update_order, $order_id);
        if ($result == TRUE) {
            //Update Stocks
            foreach ($order_data as $order) {
                $product_id = $order['product_id'];
                $batch_no = $order['batch_no'];
                $quantity_order = $order['quantity_order'];

                // Update the product stock in the database
                $this->db->set('stocks', 'stocks - ' . (int)$quantity_order, FALSE);
                $this->db->where('stock_id', $batch_no);
                $this->db->update('product_stocks');

                //Product
                $this->db->set('available_stocks', 'available_stocks - ' . (int)$quantity_order, FALSE);
                $this->db->where('product_id', $product_id);
                $this->db->update('product');
            }

            if ($referral_code != '') {
                $check_referral = $this->online_order_model->get_referral_info($referral_code);
                if ($check_referral->num_rows() > 0) {
                    $row = $check_referral->row();
                    //Compute 25% reseller
                    $commission_amt = $subtotal * 0.25;
                    $insert_commission = array(
                        'user_id'           => $row->user_id,
                        'order_id'          => $order_id,
                        'sales_amount'      => $subtotal,
                        'commission_amt'    => $commission_amt,
                        'date_created'      => date('Y-m-d H:i:s'),
                        'remarks'           => 'Reseller',
                    );
                    $this->db->insert('reseller_commission', $insert_commission);
                    //Get
                    $user_info = $this->online_order_model->get_user_referral_info($row->user_id);
                    if (isset($user_info->recruiter_id) && $user_info->recruiter_id != 0) {
                        //Compute 5% reseller
                        $recruiter_commission = $subtotal * 0.05;

                        $insert_commission = array(
                            'user_id'           => $user_info->recruiter_id,
                            'order_id'          => $order_id,
                            'sales_amount'      => $subtotal,
                            'commission_amt'    => $recruiter_commission,
                            'date_created'      => date('Y-m-d H:i:s'),
                            'remarks'           => 'Recruiter',
                        );
                        $this->db->insert('reseller_commission', $insert_commission);
                    }
                }
            }

            $success = 'The order successfully preparing.';
        } else {
            $error = 'Failed to prepare the order.';
        }
        $output = array(
            'success' => $success,
            'error' => $error,
        );
        echo json_encode($output);
    }

}