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

class News extends MY_Controller
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
        $this->load->model('website/news_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
    } //End __construct

    public function get_latest_news()
    {
        $output = '';
        $news = $this->news_model->get_latest_news();

        if ($news) {
            $img = base_url()."assets/images/logo.png";
            if(!empty($news->news_image)){
                if(file_exists('./assets/uploaded_file/news/'.$news->news_image)){
                    $img = base_url()."assets/uploaded_file/news/".$news->news_image;
                }
            }

            $news_id = $this->cipher->encrypt($news->news_id);

            if ($news->news_link != '') {
                $url = $news->news_link;
            } else {
                $url = base_url('news/news-detail?id=').$news_id;
            }

            $output = '
                <div class="col-md-6">
                    <img src="'.$img.'"
                        alt="Featured Post" class="w-100 h-100 object-fit-cover">
                </div>
                <div class="col-md-6 p-4 p-lg-5">
                    <h1 class="h1 mb-3">'.ucwords($news->news_title).'</h1>
                    <div class="text-muted fs-5 mb-4">
                        '.$news->content.'
                    </div>
                    <a href="'.$url.'" target="_blank" class="btn btn-primary ">Read More</a>
                </div>
            ';
        }

        $data['latest_news'] = $output;
        echo json_encode($data);
    }

    public function get_news_list($page = 0)
    {
        $output = '';
        $config = array();
        $config["base_url"] = base_url() . "website/news/get_news_list/";
        $config["total_rows"] = $this->news_model->get_news_count();
        $config["per_page"] = 3;
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

        $news = $this->news_model->get_news_list($config["per_page"], $page);
        if ($news->num_rows() > 0) {
            foreach($news->result() as $list) {
                $img = base_url()."assets/images/logo.png";
                if(!empty($list->news_image)){
                    if(file_exists('./assets/uploaded_file/news/'.$list->news_image)){
                        $img = base_url()."assets/uploaded_file/news/".$list->news_image;
                    }
                }

                $news_id = $this->cipher->encrypt($list->news_id);

                if ($list->news_link != '') {
                    $url = $list->news_link;
                } else {
                    $url = base_url('news/news-detail?id=').$news_id;
                }

                $output .= '
                    <div class="col-md-4">
                        <div class="news-card card shadow-sm">
                            <img src="'.$img.'"
                                alt="News 3" class="card-img-top">
                            <div class="card-body py-4">
                                <h1 class="fs-4 mb-3 mt-2">'.ucwords($list->news_title).'</h1>
                                <div class="text-muted fs-5 mt-0 mb-3 news-description">
                                    '.$list->content.'
                                </div>
                                <a href="'.$url.'" target="_blank" class="news__read-more text-decoration-none">Read More →</a>
                            </div>
                        </div>
                    </div>
                ';
            }
        } else {
            $output .= '
                <div class="alert alert-danger"><i class="bi bi-info-circle me-2"></i>No news found.</div>
            ';
        }

        $data['news_list'] = $output;
        echo json_encode($data);
    }

    public function get_featured_product()
    {
        $output = '';
        $product = $this->news_model->get_featured_product();

        foreach($product as $list) {
            $img = base_url()."assets/images/logo.png";
            if(!empty($list->main_product_img)){
                if(file_exists('./assets/uploaded_file/uploaded_product/'.$list->main_product_img)){
                    $img = base_url()."assets/uploaded_file/uploaded_product/".$list->main_product_img;
                }
            }

            $output .= '
                <div class="product-card mb-4">
                    <div class="product-image-container">
                        <img class="product-image" src="'.$img.'"
                            alt="Shantal Beauty">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">'.ucwords($list->product_name).'</h3>
                        <p class="product-description" title="'.$list->description.'">
                            '.$list->description.'
                        </p>
                        <div class="product-meta">
                            <div class="product-price">₱ '.number_format($list->selling_price,2).'</div>
                        </div>
                        <a href="'.base_url('/products').'">
                            <button class="buy-now">Shop Now</button>
                        </a>
                    </div>
                </div>
            ';
        }
        $data['featured_product'] = $output;
        echo json_encode($data);
    }
}