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
                                    </div>
                                    <div class="product__item__status">
                                        Best seller
                                    </div>
                                </div>
                                <h1 class="product__item--name view_product" data-id="'.$product_id.'">'.ucwords($list->product_name).'</h1>
                                <div class="d-flex justify-content-between align-items-center ">
								<div class="d-flex align-items-center gap-3 py-4">
									<div class="product__item--price">₱ '.number_format($list->selling_price,2).'</div>
									<div class="product__item--price--discounted">₱ 799</div>
								</div>
								<div class="product__item__quantity-selector">
                                        <i class="fa-solid fa-minus product__item__quantity-selector__minus"></i>
                                        <input type="text" value="1"
                                            class="product__item__quantity-selector__input input qty_input" readonly>
                                        <i class="fa-solid fa-plus product__item__quantity-selector__plus" data-stocks="'.$list->available_stocks.'"></i>
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

    public function buy_now()
    {
        $success = '';
        $error = '';

        $product_id = $this->input->post('product_id', true);
        $qty = $this->input->post('qty', true);
        $user_id = $this->session->userdata('customerIn')['user_id'];

        //Insert Cart
        $insert_cart = array(
            'user_id'       => $user_id,
            'product_id'    => $product_id,
            'quantity'      => $qty,
            'date_created'  => date('Y-m-d H:i:s'),
            'status'        => 2 //Buy now
        );
        $cart_id = $this->product_model->insert_buy_now($insert_cart);
        if ($cart_id != '') {
            $encrypted_cart_id = $this->cipher->encrypt($cart_id);
            $checkoutURL = base_url('shop/checkout?product=').$encrypted_cart_id;
        } else {
            $error = 'Failed to add the product on cart.';
        }
        $output = array(
            'checkoutURL' => $checkoutURL,
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
						<div class="d-flex align-items-center">
							<input type="checkbox" class="cart__item__check_product check_product" 
								'.$disabled.'
								value="'.$list->product_id.'" data-stock="'.$stocks.'" data-cart_id="'.$cart_id.'" data-price="'.$list->selling_price.'">
						</div>
                        <img class="cart__product-img"
                            src="'.$img.'" alt="Product 1">
                        <div class="d-flex flex-column justify-content-between" style="width:100%">
                            <div>
								<div class="d-flex align-items-start justify-content-between">
                                	<h1 class="cart__product-name">'.ucwords($list->product_name).'</h1>
									<div class="cart__product__item__delete-btn" data-id="'.$list->cart_id.'" data-stock="'.$stocks.'"><i class="bi bi-trash"></i></div>
								</div>
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

    public function delete_cart_item()
    {
        $success = '';
        $error = '';
        $cart_id = $this->input->post('cart_id', true);

        $delete_cart = $this->product_model->delete_cart_item($cart_id);
        if ($delete_cart == TRUE) {
            $success = 'Item in cart deleted syccessfully.';
        } else {
            $error = 'Failed to delete the item from the cart.';
        }

        $output = array(
            'success' => $success,
            'error' => $error,
        );
        echo json_encode($output);
    }

    //=============================Checkout Page==============================

    private function formatPhoneNumber($mobileNumber) {
        // Remove leading zero and replace it with +63
        if (substr($mobileNumber, 0, 1) == '0') {
            $mobileNumber = '+63' . substr($mobileNumber, 1);
        }
    
        // Format the number with spaces
        $formattedNumber = preg_replace('/(\+63)(\d{3})(\d{3})(\d{4})/', '($1) $2 $3 $4', $mobileNumber);
    
        return $formattedNumber;
    }

    public function get_delivery_address()
    {
        $output = '';
        $user_id = $this->session->userdata('customerIn')['user_id'];

        $address = $this->product_model->get_delivery_address_list($user_id);

        if ($address->num_rows() > 0) {
            $no = 0;
            foreach($address->result() as $list) {
                $no++;
                $contact_no = $this->formatPhoneNumber($list->contact_no);

                if ($list->set_as_default == 1) {
                    $default = '<span class="badge bg-warning text-white">Default</span>';
                } else {
                    $default = '';
                }

                if ($list->selected_address == 1) {
                    $checked = 'checked';
                    $delete_btn = '';
                } else {
                    $checked = '';
                    $delete_btn = '<div class="delete--btn delete_address" data-id="'.$list->shipping_id.'"><i class="bi bi-trash"></i></div>';
                }

                $address = $list->street_name.' '.ucwords($list->barangay).', '.ucwords($list->municipality).', '.ucwords($list->province).' '.$list->postal_code;

                $output .= '
                    <div class="address_list__container">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="form-check checkbox d-flex align-items-center gap-3">
                                <input class="form-check-input cart__item__check_all-product change_delivery_address" data-id="'.$list->shipping_id.'" type="radio" name="address_selection" id="address_selection'.$no.'" '.$checked.'>
                                <label class="form-check-label" for="address_selection'.$no.'" style="font-size:14px; font-weight:500; margin-top:4px;">
                                    <span class="fw-bold">'.ucwords($list->fullname).'</span> | '.$contact_no.'
                                </label>
                            </div>
                            '.$delete_btn.'
                        </div>
                        <div style="margin-left:25px; font-size:13px; color:#636e72;">
                            <div>Landmark: '.$list->landmark.'</div>
                            <div>'.$address.'</div>
                            '.$default.'
                        </div>
                    </div>
                    <hr>
                ';
            }
        } else {
            $output .= '<div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>No delivery address found.</div>';
        }
        $data['address_list'] = $output;
        echo json_encode($data);
    }

    public function get_default_address()
    {
        $output = '';
        $default_address = $this->product_model->get_selected_address();
        if ($default_address->num_rows() > 0) {
            $address = $default_address->row();
            $complete_address = $address->street_name.' '.ucwords($address->barangay).', '.ucwords($address->municipality).', '.ucwords($address->province).' '.$address->postal_code;
            $contact_no = $this->formatPhoneNumber($address->contact_no);

            $output = '
                <h1 class="checkout__address__name">'.ucwords($address->fullname).' | '.$contact_no.'</h1>
                <p class="checkout__address__p">'.$complete_address.'</p>
                <p class="checkout__address__p">Landmark: '.$address->landmark.'</p>
                <input type="hidden" class="shipping_id" value="'.$address->shipping_id.'">
            ';
        } else {
            $output = '<div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>No delivery address found.</div>';
        }
        $data['default_address'] = $output;
        echo json_encode($data);
    }

    public function save_address()
    {
        $success = '';
        $error = '';
        $fullname = $this->input->post('fullname', true);
        $contact_no = $this->input->post('contact_no', true);
        $province_name = $this->input->post('province_name', true);
        $municipality_name = $this->input->post('municipality_name', true);
        $brgy_name = $this->input->post('brgy_name', true);
        $postal_code = $this->input->post('postal_code', true);
        $street_name = $this->input->post('street_name', true);
        $landmark = $this->input->post('landmark', true);
        $label_as = $this->input->post('label_as', true);
        $set_default = $this->input->post('set_default', true);
        $user_id = $this->session->userdata('customerIn')['user_id'];
        
        if ($set_default == 1) {
            $check_address = $this->product_model->get_default_address();
            if ($check_address->num_rows() > 0) {
                //With already default address
                $insert_default = array(
                    'user_id'           => $user_id,
                    'fullname'          => $fullname,
                    'contact_no'        => $contact_no,
                    'province'          => $province_name,
                    'municipality'      => $municipality_name,
                    'barangay'          => $brgy_name,
                    'street_name'       => $street_name,
                    'postal_code'       => $postal_code,
                    'landmark'          => $landmark,
                    'label_as'          => $label_as,
                    'set_as_default'    => 1,
                    'selected_address'  => 1,
                    'date_created'      => date('Y-m-d H:i:s'),
                );
                $this->product_model->update_address($user_id);
                $result = $this->product_model->insert_delivery_address($insert_default);
                if ($result == TRUE) {
                    $success = 'Address successfully saved.';
                } else {
                    $error = 'Failed to save the address.';
                }
            } else {
                //Without default address
                $insert_default = array(
                    'user_id'           => $user_id,
                    'fullname'          => $fullname,
                    'contact_no'        => $contact_no,
                    'province'          => $province_name,
                    'municipality'      => $municipality_name,
                    'barangay'          => $brgy_name,
                    'street_name'       => $street_name,
                    'postal_code'       => $postal_code,
                    'landmark'          => $landmark,
                    'label_as'          => $label_as,
                    'set_as_default'    => 1,
                    'selected_address'  => 1,
                    'date_created'      => date('Y-m-d H:i:s'),
                );
                $result = $this->product_model->insert_delivery_address($insert_default);
                if ($result == TRUE) {
                    $success = 'Address successfully saved.';
                } else {
                    $error = 'Failed to save the address.';
                }
            }
        } else {
            $insert_default = array(
                'user_id'           => $user_id,
                'fullname'          => $fullname,
                'contact_no'        => $contact_no,
                'province'          => $province_name,
                'municipality'      => $municipality_name,
                'barangay'          => $brgy_name,
                'street_name'       => $street_name,
                'postal_code'       => $postal_code,
                'landmark'          => $landmark,
                'label_as'          => $label_as,
                'set_as_default'    => 0,
                'selected_address'  => 0,
                'date_created'      => date('Y-m-d H:i:s'),
            );
            $result = $this->product_model->insert_delivery_address($insert_default);
            if ($result == TRUE) {
                $success = 'Address successfully saved.';
            } else {
                $error = 'Failed to save the address.';
            }
        }
        $output = array(
            'success' => $success,
            'error' => $error,
        );
        echo json_encode($output);
    }

    public function change_delivery_address()
    {
        $success = '';
        $error = '';
        $shipping_id = $this->input->post('shipping_id', true);

        $result = $this->product_model->change_delivery_address($shipping_id);
        if ($result == TRUE) {
            $success = 'Delivery address successfully updated.';
        } else {
            $error = 'Failed to update the delivery address.';
        }
        $output = array(
            'success' => $success,
            'error' => $error,
        );
        echo json_encode($output);
    }

    public function delete_address()
    {
        $success = '';
        $error = '';
        $shipping_id = $this->input->post('shipping_id', true);

        $result = $this->product_model->delete_address($shipping_id);
        if ($result == TRUE) {
            $success = 'Delivery address successfully deleted.';
        } else {
            $error = 'Failed to delete the delivery address.';
        }
        $output = array(
            'success' => $success,
            'error' => $error,
        );
        echo json_encode($output);
    }

    public function check_referral_code() 
    {
        $success = '';
        $error = '';
        $referral_code = $this->input->post('referral_code', true);

        $check_referral = $this->product_model->check_referral_code($referral_code);
        if($check_referral->num_rows() > 0) {
            $reseller = $check_referral->row();

            $reseller_id = isset($reseller->reseller_id) ? $reseller->reseller_id : '';
            $success = 'Valid referral code.';
        } else {
            $reseller_id = '';
            $error = 'Referral code not found.';
        }
        $output = array(
            'success' => $success,
            'error' => $error,
            'reseller_id' => $reseller_id,
        );
        echo json_encode($output);
    }

    public function check_voucher_code()
    {
        $success = '';
        $error = '';
        $voucher_code = $this->input->post('voucher_code', true);
        $reseller_id = $this->input->post('reseller_id', true);

        $check_voucher= $this->product_model->check_voucher_code($voucher_code, $reseller_id);
        if($check_voucher->num_rows() > 0) {
            $voucher = $check_voucher->row();
            $end_date = isset($voucher->end_date) ? $voucher->end_date : '';
            $dateToday = date('Y-m-d');

            if ($dateToday > $end_date) {
                $voucher_amt = '';
                $voucher_desc = '';
                $voucher_code = '';
                $error = 'Voucher already expired.';
            } else {
                $voucher_amt = isset($voucher->voucher_amt) ? $voucher->voucher_amt : '';
                $voucher_desc = isset($voucher->description) ? $voucher->description : '';
                $voucher_code = isset($voucher->voucher_code) ? $voucher->voucher_code : '';
                $success = 'Valid voucher code.';
            }
        } else {
            $voucher_amt = '';
            $voucher_desc = '';
            $voucher_code = '';
            $error = 'Invalid voucher.';
        }
        $output = array(
            'success' => $success,
            'error' => $error,
            'voucher_amt' => $voucher_amt,
            'voucher_desc' => $voucher_desc,
            'voucher_code' => $voucher_code,
        );
        echo json_encode($output);
    }

    public function process_checkout()
    {
        $error = '';
        $success = '';

        $cart_ids = $this->input->post('cart_ids', true);
        $product_ids = $this->input->post('product_ids', true);
        $qtyOrders = $this->input->post('qtyOrders', true);

        $shipping_id = $this->input->post('shipping_id', true);
        $subtotal = $this->input->post('subtotal', true);
        $delivery_fee = $this->input->post('delivery_fee', true);
        $referral_code = $this->input->post('referral_code', true);
        $voucher_code = $this->input->post('voucher_code', true);
        $voucher_discount_amt = $this->input->post('voucher_discount_amt', true);
        $total_amount = $this->input->post('total_amount', true);
        $payment_method = $this->input->post('payment_method', true);
        $no_items = $this->input->post('no_items', true);
        $messageForSeller = $this->input->post('messageForSeller', true);
        
        $subtotal = str_replace(['₱', ','], '', $subtotal);
        $delivery_fee = str_replace(['-', ','], '', $delivery_fee);
        $voucher_discount_amt = str_replace(['₱', ','], '', $voucher_discount_amt);
        $total_amount = str_replace(['₱', ','], '', $total_amount);
        
        $order_no = 'ORDR'.date('Ymd').mt_rand(1000, 9999);

        $insert_order = array(
            'order_no'              => $order_no,
            'user_id'               => $this->session->userdata('customerIn')['user_id'],
            'shipping_id'           => $shipping_id,
            'sub_total'             => $subtotal,
            'shipping_fee'          => $delivery_fee,
            'discount_voucher_amt'  => $voucher_discount_amt,
            'total_amount'          => $total_amount,
            'referral_code'         => $referral_code,
            'voucher_code'          => $voucher_code,
            'payment_type'          => $payment_method,
            'no_items'              => $no_items,
            'order_status'          => 'Pending',
            'message_to_seller'     => $messageForSeller,
            'date_created'          => date('Y-m-d H:i:s'),
        );

        $order_id = $this->product_model->process_checkout($insert_order);
        if ($order_id != '') {
            //Insert each product related to the order
            foreach($product_ids as $key => $product_id) {
                $insert_order_product = [
                    'order_id'          => $order_id,
                    'product_id'        => $product_id,
                    'quantity_order'    => $qtyOrders[$key], // Match quantity with product ID
                    'date_created'      => date('Y-m-d H:i:s'),
                ];

                $this->product_model->insert_order_product($insert_order_product);
            }
            $this->db->where_in('cart_id', $cart_ids);
            $this->db->update('cart_item', array('status' => 1));

            $success = "Order successfully placed!";
        } else {
            $error = "Failed to process the order.";
        }

        $output = array(
            'success' => $success,
            'error' => $error,
        );
        echo json_encode($output);
    }

    public function get_municipal($prov = NULL, $value = NULL)
    {
        $code = $prov ? $prov:$this->input->post('code',TRUE);
        $prov_code = substr($code,0,4);
        if ($prov_code == 1339) {
            $this->db->like('code', '1339', 'after')->or_like('code', '1374', 'after')->or_like('code', '1375', 'after')->or_like('code', '1376', 'after');
        } else {
            $this->db->like('code', $prov_code, 'after');
        }
        $res = $this->db->select('*')->from('psgc_municipal')->order_by('name', 'ASC')->get()->result();
		$option = '<option value="">Select Municipality</option>';
		foreach($res as $val){
			$option .= '<option value="'.$val->code.'" '.($value && $value == $val->code ? 'selected':'').'>'.ucwords($val->name).'</option>';
		}
		if($prov)
			return $option;
		else
			echo json_encode($option);
    }

    public function get_barangay($muni = NULL, $value = NULL)
    {
        $code = $muni ? $muni : $this->input->post('code', TRUE);

        $brgy = $this->db->like('code', substr($code, 0, 6), 'after')->order_by('name', 'ASC')->get('psgc_brgy')->result();
        // print_r($brgy);
        $option = '<option value="">Select Barangay</option>';
        foreach ($brgy as $val) {
            $option .= '<option value="' . $val->code . '" ' . ($value && $value == $val->code ? 'selected' : '') . '>' . ucwords($val->name) . '</option>';
        }
        if ($muni)
            return $option;
        else
            echo json_encode($option);
    }

    //=============================End of Checkout============================

}