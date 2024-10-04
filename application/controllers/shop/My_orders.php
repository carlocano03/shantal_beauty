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

    //To Pay
    public function get_order_list()
    {
        $output = '';
        $status = $this->input->post('status');
        $orders = $this->my_order_model->get_order_list($status);

        if ($orders->num_rows() > 0) {
            foreach($orders->result() as $list) {
                $output .= '
                    <div class="my-order__section__order-header d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="my-order__orderNo">'.$list->order_no.'</h1>
                            <small class="text-muted">Place on: '.date('D M j, Y h:i A', strtotime($list->date_created)).'</small>
                        </div>
						<button type="button" class="my-order__product__cancel-order cancel_order" data-id="'.$list->order_id.'">Cancel Order</button>
                    </div>
                ';

                $output .= '
                    <div class="my-order__section__order-products">
                ';

                $output .= '
                    <div class="my-order__section__product ">
                    <div class="my-order__section__product__items">
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

                        $product_id = $this->cipher->encrypt($info->product_id);

                        $output .='
                            <div class="d-flex  my-order__section__product__item">
                                <img src="'.$img.'"
                                    class="my-order__section__product-img me-4" alt="Product 1">
                                <div class="d-flex flex-column justify-content-between">
                                    <div>
                                        <p class="my-order__product__name view_product" data-id="'.$product_id.'">'.ucwords($info->product_name).'</p>
                                        <p class="my-order__product__quantity">Quantity: '.$info->quantity_order.'</p>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }

                $output .= '
                        </div>
                        <div class="my-order__section__product__total-container">
                            <div class="my-order__section__product__total__shipping" style="color:#95a5a6;">Shipping Amount: -'.number_format($list->shipping_fee, 2).'</div>
                            <div class="my-order__section__product__total__total fw-bold">Total Amount: ₱'.number_format($list->total_amount, 2).'</div>
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
    //End of To Pay

    public function cancel_order()
    {
        $error = '';
        $success = '';

        $order_id = $this->input->post('order_id', true);

        $check_order = $this->my_order_model->check_order($order_id);
        if ($check_order->num_rows() > 0) {
            $update_order = array(
                'order_status' => 'Cancelled',
            );
            $result = $this->my_order_model->update_order_status($update_order, $order_id);
            if ($result == TRUE) {
                $success = 'Your order is successfully cancelled.';
            } else {
                $error = 'Failed to cancel your order.';
            }
        } else {
            $error = 'Failed to cancel your order.';
        }

        $output = array(
            'success' => $success,
            'error' => $error,
        );
        echo json_encode($output);
    }

    //To Ship
    public function get_count_order_ship()
    {
        $status = $this->input->post('status');
        $order = $this->my_order_model->get_count_order($status);
        $order_info = $order->row_array();

        $output = array(
            'count' => $order->num_rows(),
        );

        echo json_encode($output);
    }

    public function get_order_ship()
    {
        $output = '';
        $status = $this->input->post('status');
        $orders = $this->my_order_model->get_order_list($status);

        if ($orders->num_rows() > 0) {
            foreach($orders->result() as $list) {
                $output .= '
                    <div class="my-order__section__order-header d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="my-order__orderNo">'.$list->order_no.'</h1>
                            <small class="text-muted">Place on: '.date('D M j, Y h:i A', strtotime($list->date_created)).'</small>
                        </div>
						<button type="button" class="my-order__product__cancel-order track_order" data-id="'.$list->order_id.'" data-order_no="'.$list->order_no.'">Track Order</button>
                    </div>
                ';

                $output .= '
                    <div class="my-order__section__order-products">
                ';

                $output .= '
                    <div class="my-order__section__product ">
                    <div class="my-order__section__product__items">
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

                        $product_id = $this->cipher->encrypt($info->product_id);

                        $output .='
                            <div class="d-flex  my-order__section__product__item">
                                <img src="'.$img.'"
                                    class="my-order__section__product-img me-4" alt="Product 1">
                                <div class="d-flex flex-column justify-content-between">
                                    <div>
                                        <p class="my-order__product__name view_product" data-id="'.$product_id.'">'.ucwords($info->product_name).'</p>
                                        <p class="my-order__product__quantity">Quantity: '.$info->quantity_order.'</p>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }

                $output .= '
                        </div>
                        <div class="my-order__section__product__total-container">
                            <div class="my-order__section__product__total__shipping" style="color:#95a5a6;">Shipping Amount: -'.number_format($list->shipping_fee, 2).'</div>
                            <div class="my-order__section__product__total__total fw-bold">Total Amount: ₱'.number_format($list->total_amount, 2).'</div>
                        </div>
                    </div>
                ';
                
                $output .= '
                    </div>
                    <hr>
                ';

            }
        } else {
            $output .= '<div class="alert alert-danger"><i class="bi bi-info-circle me-2"></i>No product to ship found.</div>';
        }

        $data = array(
            'order_list_ship' => $output,
        );
        echo json_encode($data);
    }
    //End of To Ship

    //To Receive
    public function get_count_order_receive()
    {
        $status = $this->input->post('status');
        $order = $this->my_order_model->get_count_order($status);
        $order_info = $order->row_array();

        $output = array(
            'count' => $order->num_rows(),
        );

        echo json_encode($output);
    }

    public function get_order_receive()
    {
        $output = '';
        $status = $this->input->post('status');
        $orders = $this->my_order_model->get_order_list($status);

        if ($orders->num_rows() > 0) {
            foreach($orders->result() as $list) {
                $output .= '
                    <div class="my-order__section__order-header d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="my-order__orderNo">'.$list->order_no.'</h1>
                            <small class="text-muted">Place on: '.date('D M j, Y h:i A', strtotime($list->date_created)).'</small>
                        </div>
						<button type="button" class="my-order__product__cancel-order track_order" data-id="'.$list->order_id.'" data-order_no="'.$list->order_no.'">Track Order</button>
                    </div>
                ';

                $output .= '
                    <div class="my-order__section__order-products">
                ';

                $output .= '
                    <div class="my-order__section__product ">
                    <div class="my-order__section__product__items">
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

                        $product_id = $this->cipher->encrypt($info->product_id);

                        $output .='
                            <div class="d-flex  my-order__section__product__item">
                                <img src="'.$img.'"
                                    class="my-order__section__product-img me-4" alt="Product 1">
                                <div class="d-flex flex-column justify-content-between">
                                    <div>
                                        <p class="my-order__product__name view_product" data-id="'.$product_id.'">'.ucwords($info->product_name).'</p>
                                        <p class="my-order__product__quantity">Quantity: '.$info->quantity_order.'</p>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }

                $output .= '
                        </div>
                        <div class="my-order__section__product__total-container">
                            <div class="my-order__section__product__total__shipping" style="color:#95a5a6;">Shipping Amount: -'.number_format($list->shipping_fee, 2).'</div>
                            <div class="my-order__section__product__total__total fw-bold">Total Amount: ₱'.number_format($list->total_amount, 2).'</div>
                        </div>
                    </div>
                ';
                
                $output .= '
                    </div>
                    <hr>
                ';

            }
        } else {
            $output .= '<div class="alert alert-danger"><i class="bi bi-info-circle me-2"></i>No product to receive found.</div>';
        }

        $data = array(
            'order_list_receive' => $output,
        );
        echo json_encode($data);
    }
    //End of To Receive

    //Completed
    public function get_count_order_completed()
    {
        $status = $this->input->post('status');
        $order = $this->my_order_model->get_count_order($status);
        $order_info = $order->row_array();

        $output = array(
            'count' => $order->num_rows(),
        );

        echo json_encode($output);
    }

    public function get_order_completed()
    {
        $output = '';
        $status = $this->input->post('status');
        $orders = $this->my_order_model->get_order_list($status);

        if ($orders->num_rows() > 0) {
            foreach($orders->result() as $list) {
                $output .= '
                    <div class="my-order__section__order-header d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="my-order__orderNo">'.$list->order_no.'</h1>
                            <small class="text-muted">Place on: '.date('D M j, Y h:i A', strtotime($list->date_created)).'</small>
                        </div>
						<button type="button" class="my-order__product__cancel-order track_order" data-id="'.$list->order_id.'">Add Review</button>
                    </div>
                ';

                $output .= '
                    <div class="my-order__section__order-products">
                ';

                $output .= '
                    <div class="my-order__section__product ">
                    <div class="my-order__section__product__items">
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

                        $product_id = $this->cipher->encrypt($info->product_id);

                        $output .='
                            <div class="d-flex  my-order__section__product__item">
                                <img src="'.$img.'"
                                    class="my-order__section__product-img me-4" alt="Product 1">
                                <div class="d-flex flex-column justify-content-between">
                                    <div>
                                        <p class="my-order__product__name view_product" data-id="'.$product_id.'">'.ucwords($info->product_name).'</p>
                                        <p class="my-order__product__quantity">Quantity: '.$info->quantity_order.'</p>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }

                $output .= '
                        </div>
                        <div class="my-order__section__product__total-container">
                            <div class="my-order__section__product__total__shipping" style="color:#95a5a6;">Shipping Amount: -'.number_format($list->shipping_fee, 2).'</div>
                            <div class="my-order__section__product__total__total fw-bold">Total Amount: ₱'.number_format($list->total_amount, 2).'</div>
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
            'order_list_completed' => $output,
        );
        echo json_encode($data);
    }
    //End of Completed

    //Cancelled
    public function get_count_order_cancel()
    {
        $status = $this->input->post('status');
        $order = $this->my_order_model->get_count_order($status);
        $order_info = $order->row_array();

        $output = array(
            'count' => $order->num_rows(),
        );

        echo json_encode($output);
    }

    public function get_order_cancel()
    {
        $output = '';
        $status = $this->input->post('status');
        $orders = $this->my_order_model->get_order_list($status);

        if ($orders->num_rows() > 0) {
            foreach($orders->result() as $list) {
                $output .= '
                    <div class="my-order__section__order-header d-flex justify-content-between align-items-center">
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
                    <div class="my-order__section__product ">
                    <div class="my-order__section__product__items">
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

                        $product_id = $this->cipher->encrypt($info->product_id);

                        $output .='
                            <div class="d-flex  my-order__section__product__item">
                                <img src="'.$img.'"
                                    class="my-order__section__product-img me-4" alt="Product 1">
                                <div class="d-flex flex-column justify-content-between">
                                    <div>
                                        <p class="my-order__product__name view_product" data-id="'.$product_id.'">'.ucwords($info->product_name).'</p>
                                        <p class="my-order__product__quantity">Quantity: '.$info->quantity_order.'</p>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }

                $output .= '
                        </div>
                        <div class="my-order__section__product__total-container">
                            <div class="my-order__section__product__total__shipping" style="color:#95a5a6;">Shipping Amount: -'.number_format($list->shipping_fee, 2).'</div>
                            <div class="my-order__section__product__total__total fw-bold">Total Amount: ₱'.number_format($list->total_amount, 2).'</div>
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
            'order_list_cancel' => $output,
        );
        echo json_encode($data);
    }
    //End of Cancelled

    public function tracking_order()
    {
        $output = '';
        $order_id = $this->input->post('order_id', true);
        $order_no = $this->input->post('order_no', true);

        $track_order = $this->my_order_model->tracking_order($order_id);

        if ($track_order->num_rows() > 0) {
            $output .= '<h5 class="order_no__track-order">'.$order_no.'</h5>';
            foreach($track_order->result() as $list) {
                $output .= '
				<li class="d-flex li-track-orders">
                        <div class="activity-dot" style="background-color: #54ba4a;outline: 5px solid rgba(84, 186, 74, .25);"></div>
                        <div class="ms-4">
                    <div class="order_no__track-order__remarks">'.$list->remarks.'</div>
                    <div class="order_no__track-order__date">'.date('D M j, Y h:i A', strtotime($list->date_created)).'</div>
					</div>
                </li>
                ';
            }
        } else {
            $output .= '<div class="alert alert-danger"><i class="bi bi-info-circle me-2"></i>No record found.</div>';
        }

        $data = array(
            'tracking_order' => $output,
        );
        echo json_encode($data);
    }

}
