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

class Products extends MY_Controller
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
        $this->load->model('shop/product_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
    } //End __construct

    public function get_product_list($page = 0)
    {
        $search_query = $this->input->get('search');
        $filter = $this->input->get('filter');
        $output = '';
        $config = array();
        $config["base_url"] = base_url() . "shop/products/get_product_list";
        $config["total_rows"] = $this->product_model->get_product_count($search_query, $filter);
        $config["per_page"] = 6;
        $config["uri_segment"] = 4; // Adjusted uri_segment to match your setup

        // Bootstrap 5 Pagination
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);
        // Fetch data based on pagination
        $data["links"] = $this->pagination->create_links();

        $products = $this->product_model->get_product_list($config["per_page"], $page, $search_query, $filter);
        if ($products->num_rows() > 0) {
            foreach ($products->result() as $list) {
                $img = base_url()."assets/images/logo.png";
                if(!empty($list->main_product_img)){
                    if(file_exists('./assets/uploaded_file/uploaded_product/'.$list->main_product_img)){
                        $img = base_url()."assets/uploaded_file/uploaded_product/".$list->main_product_img;
                    }
                }

                $product_id = $this->cipher->encrypt($list->product_id);

                if ($list->available_stocks == 0) {
                    $action = '<div class="product__item--btn_wishlist" id="add_wishlist" data-id="'.$list->product_id.'">Add to wishlist</div>';
                } else {
                    $action = '<div class="product__item--btn" id="add_cart" data-id="'.$list->product_id.'">Add to cart</div>';
                }

                $output .= '
                    <div class="col" title="'.ucwords($list->product_name).'">
                        <div class="product__item">
                            <i class="bi bi-heart product__item--heart"></i>
                            <div class="product__item__img-container">
                                <img class="product__item--img view_product" data-id="'.$product_id.'"
                                    src="'.$img.'" alt="Product 1">
                            </div>
                            <div class="product__item--content">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="product__item__ratings__container">
                                            <i class="bi bi-star-fill product__item__ratings__item"></i>
                                            <i class="bi bi-star-fill product__item__ratings__item"></i>
                                            <i class="bi bi-star-fill product__item__ratings__item"></i>
                                            <i class="bi bi-star-fill product__item__ratings__item"></i>
                                            <i class="bi bi-star-fill product__item__ratings__item"></i>
                                        </div>
                                        <div class="product__item__review">(100 reviews)</div>
                                    </div>

                                    <div class="product__item__status">
                                        Best seller
                                    </div>
                                </div>
                                <h1 class="product__item--name view_product" data-id="'.$product_id.'">'.ucwords($list->product_name).'</h1>
                                <p class="product__item--p" title="'.$list->description.'">'.$list->description.'</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="product__item--price">₱ '.number_format($list->selling_price,2).'</div>
                                    <div class="product__item__quantity-selector">
                                        <i class="fa-solid fa-minus product__item__quantity-selector__minus"></i>
                                        <input type="text" value="1"
                                            class="product__item__quantity-selector__input input qty_input" readonly>
                                        <i class="fa-solid fa-plus product__item__quantity-selector__plus"></i>
                                    </div>
                                </div>
                            </div>
                            '.$action.'
                        </div>
                    </div>
                ';
            }
        } else {
            $output .= '
                <div class="alert alert-danger"><i class="bi bi-info-circle me-2"></i>No product found.</div>
            ';
        }

        $data['product_list'] = $output;
        echo json_encode($data);
    }

    public function cart_count()
    {
        $cart_count = $this->product_model->get_cart_count($this->session->userdata('customerIn')['user_id']);

        $output = array(
            'cart_count' => number_format($cart_count),
        );
        echo json_encode($output);
    }

    public function add_cart()
    {
        $success = '';
        $error = '';

        $product_id = $this->input->post('product_id', true);
        $qty = $this->input->post('qty', true);
        $user_id = $this->session->userdata('customerIn')['user_id'];

        $check_cart = $this->product_model->check_cart($product_id, $user_id);
        if ($check_cart->num_rows() > 0) {
            //Update Cart
            $result = $this->product_model->increment_cart($product_id, $user_id, $qty);
            if ($result) {
                $success = 'Product successfully added to cart.';
            } else {
                $error = 'Failed to add the product on cart.';
            }
        } else {
            //Insert Cart
            $insert_cart = array(
                'user_id'       => $user_id,
                'product_id'    => $product_id,
                'quantity'      => $qty,
                'date_created'  => date('Y-m-d H:i:s'),
            );
            $result = $this->product_model->insert_cart($insert_cart);
            if ($result) {
                $success = 'Product successfully added to cart.';
            } else {
                $error = 'Failed to add the product on cart.';
            }
        }
        $output = array(
            'success' => $success,
            'error' => $error,
        );
        echo json_encode($output);
    }

    public function get_cart_item_list()
    {
        $output = '';
        $user_id = $this->session->userdata('customerIn')['user_id'];

        $cart_list = $this->product_model->get_cart_item_list($user_id);
        if ($cart_list->num_rows() > 0) {
            foreach($cart_list->result() as $list) {
                $img = base_url()."assets/images/logo.png";
                if(!empty($list->main_product_img)){
                    if(file_exists('./assets/uploaded_file/uploaded_product/'.$list->main_product_img)){
                        $img = base_url()."assets/uploaded_file/uploaded_product/".$list->main_product_img;
                    }
                }

                $cart_id = urlencode($this->cipher->encrypt($list->cart_id));

                if ($list->available_stocks == 0) {
                    $stocks = 'No Stocks';
                    $disabled = 'disabled';
                    $opacity = 'opacity:0.4';
                    $available_stocks = 'Out of Stock';
                } else {
                    $stocks = '';
                    $disabled = '';
                    $opacity = '';
                    $available_stocks = 'Available Stocks: '.number_format($list->available_stocks);
                }

                $output .= '
                    <div class="cart__item" style="'.$opacity.'">
                        <input type="checkbox" class="check_product" 
                            '.$disabled.'
                            value="'.$list->product_id.'" data-stock="'.$stocks.'" data-cart_id="'.$cart_id.'" data-price="'.$list->selling_price.'">

                        <img class="cart__product-img"
                            src="'.$img.'" alt="Product 1">
                        <div class="d-flex flex-column justify-content-between">
                            <div>
                                <h1 class="cart__product-name">'.ucwords($list->product_name).'</h1>
                                <p class="cart__product-p">'.$available_stocks.'</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="cart__item__quantity-selector">
                                    <i class="fa-solid fa-minus cart__item__quantity-selector__minus" data-cart_id="'.$list->cart_id.'"></i>
                                    <input readonly value="'.$list->quantity.'" type="text" class="cart__item__quantity-selector__input qty_cart">
                                    <i class="fa-solid fa-plus cart__item__quantity-selector__plus" data-cart_id="'.$list->cart_id.'" data-stocks="'.$list->available_stocks.'"></i>
                                </div>
                                <div class="cart__product-price" data-price="'.$list->selling_price.'">₱'.number_format($list->selling_price,2).'</div>
                            </div>
                        </div>
                    </div>
                ';
            }
        } else {
            $output .= '
                <div class="alert alert-danger"><i class="bi bi-info-circle me-2"></i>No item on cart.</div>
            ';
        }
        $data['cart_item_list'] = $output;
        echo json_encode($data);
    }

    public function update_cart_qty()
    {
        $success = '';
        $error = '';

        $cart_id = $this->input->post('cart_id', true);
        $action = $this->input->post('action', true);

        switch ($action) {
            case 'Plus':
                $result = $this->product_model->increment_cart_qty($cart_id);
                break;
            
            case 'Minus':
                $result = $this->product_model->decrement_cart_qty($cart_id);
                break;
        }
        if ($result) {
            $success = 'Quantity successfully updated.';
        } else {
            $error = 'Failed to update the quantity.';
        }
        $output = array(
            'success' => $success,
            'error' => $error,
        );
        echo json_encode($output);
    }

    public function search_items() 
    {
        $postData = $this->input->post();
        $products = $this->product_model->search_items($postData);

        // Return products as JSON
        echo json_encode($products);
    }

}