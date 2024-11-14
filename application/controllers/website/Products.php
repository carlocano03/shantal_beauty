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
        $this->load->model('website/product_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
    } //End __construct

    public function get_product_list($page = 0)
    {
        $search_query = $this->input->get('search');
        $output = '';
        $config = array();
        $config["base_url"] = base_url() . "website/products/get_product_list";
        $config["total_rows"] = $this->product_model->get_product_count($search_query);
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

        $products = $this->product_model->get_product_list($config["per_page"], $page, $search_query);
        if ($products->num_rows() > 0) {
            foreach ($products->result() as $list) {
                $img = base_url()."assets/images/logo.png";
                if(!empty($list->main_product_img)){
                    if(file_exists('./assets/uploaded_file/uploaded_product/'.$list->main_product_img)){
                        $img = base_url()."assets/uploaded_file/uploaded_product/".$list->main_product_img;
                    }
                }

                $output .= '
                    <div class="col">
                        <div class="product-card">
                            <div class="product-image-container">
                                <img class="product-image" src="'.$img.'"
                                    alt="Shantal Beauty">
                            </div>
                            <div class="product-info">
                                <div class="product-category">NET WT. '.$list->net_weight.'</div>
                                <h3 class="product-name">'.ucwords($list->product_name).'</h3>
                                <p class="product-description" title="'.$list->description.'">
                                    '.$list->description.'
                                </p>
                                <div class="product-meta">
                                    <div class="product-price">₱ '.number_format($list->selling_price,2).'</div>
                                </div>
                                <div class="button-group">
                                    <button class="buy-now" data-bs-toggle="modal" data-bs-target="#buy-now">Buy Now</button>
                                    <button class="view-details" data-id="'.$list->product_id.'">
                                        View
                                    </button>
                                </div>
                            </div>
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

    public function search_items() 
    {
        $postData = $this->input->post();
        $products = $this->product_model->search_items($postData);

        // Return products as JSON
        echo json_encode($products);
    }

    public function product_details()
    {
        $product_id = $this->input->post('product_id', true);

        $product = $this->product_model->get_product_details($product_id);

        if ($product->num_rows() > 0) {
            $list = $product->row();

            $img = base_url()."assets/images/logo.png";
            if(!empty($list->main_product_img)){
                if(file_exists('./assets/uploaded_file/uploaded_product/'.$list->main_product_img)){
                    $img = base_url()."assets/uploaded_file/uploaded_product/".$list->main_product_img;
                }
            }

            $output = '
                <div class="col-md-6">
                    <img class="modal-product-image"
                        src="'.$img.'" alt="Shantal Beauty">
                </div>
                <div class="col-md-6">
                    <div class="modal-product-details">
                        <h2 class="modal-product-name">'.ucwords($list->product_name).'</h2>
                        <div class="modal-product-price mb-3">₱ '.number_format($list->selling_price,2).'</div>
                        <div class="modal-product-description">
                            <h4>Description</h4>
                            <p class="product-desc" title="'.$list->description.'"> 
                                '.$list->description.'
                            </p>
                        </div>
                        <button class="buy-now mt-5 mb-3" data-bs-toggle="modal" data-bs-target="#buy-now">Buy
                            Now</button>
                    </div>
                </div>
            ';

        } else {
            $output = '
                <div class="alert alert-danger"><i class="bi bi-info-circle me-2"></i>No product details found.</div>
            ';
        }

        $data['product_details'] = $output;
        $data['product'] = ucwords($list->product_name);
        echo json_encode($data);
    }

    public function get_product_swiper()
    {
        $output = '';
        $product = $this->product_model->get_product_swiper();
        
        foreach($product as $list) {
            $img = base_url()."assets/images/logo.png";
            if(!empty($list->main_product_img)){
                if(file_exists('./assets/uploaded_file/uploaded_product/'.$list->main_product_img)){
                    $img = base_url()."assets/uploaded_file/uploaded_product/".$list->main_product_img;
                }
            }

            $output .= '
                <swiper-slide>
                    <div class=" row products__row">
                        <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center">
                            <div class="products__wrapper">
                                <img class="products__product-img-1"
                                    src="'.$img.'"
                                    alt="Shantals Temptation Coffee">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <h1 class="products__product__title">'.ucwords($list->product_name).'</h1>
                            <div class="product-category">NET WT. '.$list->net_weight.'</div>
                            <div class="d-flex flex-column gap-5 mt-5">
                                <p class="products__product_p" style="text-align:justify;">
                                    '.$list->description.'
                                </p>
                                
                            </div>
                            <div class="products__btn__container">
                                <button class="products__btn__buy-now" data-bs-toggle="modal"
                                    data-bs-target="#platform">Buy Now</button>
                                <div class="products__btn__price">₱ '.number_format($list->selling_price,2).'</div>
                            </div>
                        </div>
                    </div>
                </swiper-slide>
            ';

        }

        $data['product_swiper'] = $output;
        echo json_encode($data);
    }

}