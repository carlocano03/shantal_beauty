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

class Wishlist extends MY_Controller
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
        $this->load->model('shop/wishlist_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
    } //End __construct

    public function get_wishlist($page = 0)
    {
        $search_query = $this->input->get('search');
        $filter = $this->input->get('filter');
        $output = '';
        $config = array();
        $config["base_url"] = base_url() . "shop/wishlist/get_wishlist";
        $config["total_rows"] = $this->wishlist_model->get_product_count($search_query, $filter);
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

        $products = $this->wishlist_model->get_product_list($config["per_page"], $page, $search_query, $filter);

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
                    $action = '<div class="product__item--btn_wishlist">Out of Stock</div>';
                } else {
                    $action = '<div class="product__item--btn" id="buy_now" data-id="'.$list->product_id.'">Buy Now</div>';
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
                                        <input type="text"
                                            class="product__item__quantity-selector__input input qty_input" readonly value="'.$list->qty.'">
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

        $data['wishlist'] = $output;
        echo json_encode($data);
    }

    public function search_items() 
    {
        $postData = $this->input->post();
        $products = $this->wishlist_model->search_items($postData);

        // Return products as JSON
        echo json_encode($products);
    }
}