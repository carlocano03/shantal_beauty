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

class My_orders extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('language');
        $this->load->library('pagination');
        $this->load->library('cipher');
        $this->lang->load('common','english');
        $this->load->model('shop/my_order_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
    } //End __construct

    public function get_count_order()
    {
        $status = $this->input->post('status');
        $order = $this->my_order_model->get_count_order($status);
        $order_info = $order->row_array();

        $output = array(
            'count' => $order->num_rows(),
        );

        echo json_encode($output);
    }

    public function get_order_list()
    {
        $output = '';
        $status = $this->input->post('status');
        $orders = $this->my_order_model->get_order_list($status);

        if ($orders->num_rows() > 0) {
            foreach($orders->result() as $list) {
                $output .= '
                    <div class="my-order__section__order-header mb-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="my-order__orderNo">'.$list->order_no.'</h1>
                            <small class="text-muted">Place on: '.date('D M j, Y h:i A', strtotime($list->date_created)).'</small>
                        </div>
                    </div>
                ';

                $output .= '
                    <div class="my-order__section__order-products">
                ';

                $output .= '
                    <div class="my-order__section__product d-flex justify-content-between align-items-center">
                        <div>
                ';

                $order_items = $this->my_order_model->get_order_details($list->order_id);
                if (!empty($order_items)) {
                    foreach($order_items as $info) {
                        $img = base_url()."assets/images/logo.png";
                        if(!empty($info->main_product_img)){
                            if(file_exists('./assets/uploaded_file/uploaded_product/'.$info->main_product_img)){
                                $img = base_url()."assets/uploaded_file/uploaded_product/".$info->main_product_img;
                            }
                        }

                        $output .='
                            <div class="d-flex align-items-center">
                                <img src="'.$img.'"
                                    class="my-order__section__product-img me-4" alt="Product 1">
                                <div class="d-flex flex-column justify-content-between">
                                    <div>
                                        <p class="my-order__product__name">'.ucwords($info->product_name).'</p>
                                        <p class="my-order__product__quantity">Quantity: '.$info->quantity_order.'</p>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }

                $output .= '
                        </div>
                        <div>
                            <button type="button" class="my-order__product__track-order">Track Order</button>
                            <div>Shipping Amount: -'.number_format($list->shipping_fee, 2).'</div>
                            <div>Total Amount: ₱'.number_format($list->total_amount, 2).'</div>
                        </div>
                    </div>
                ';
                
                $output .= '
                    </div>
                    <hr>
                ';

            }
        } else {
            $output .= '<div class="alert alert-danger"><i class="bi bi-info-circle me-2"></i>No product found.</div>';
        }

        $data = array(
            'order_list' => $output,
        );
        echo json_encode($data);
    }


}