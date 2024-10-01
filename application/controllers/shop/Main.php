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

class Main extends MY_Controller
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
        $this->load->model('shop/product_model');
        $this->load->model('shop/main_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');

        //Check Session
        $this->check_session('customerIn', '');
    } //End __construct

    public function index()
    {
        $data['title'] = 'Shantal`s Shop';
        $this->load->view('website/shop/partial/_header', $data);
        $this->load->view('website/shop/partial/_navbar', $data);
        $this->load->view('website/shop/index', $data);
        $this->load->view('website/shop/partial/_footer', $data);
    }
	public function best_sellers()
    {
        $data['title'] = 'Shantal`s Shop';
        $this->load->view('website/shop/partial/_header', $data);
        $this->load->view('website/shop/partial/_navbar', $data);
        $this->load->view('website/shop/best-sellers', $data);
        $this->load->view('website/shop/partial/_footer', $data);
    }
	public function sales_offers()
    {
        $data['title'] = 'Shantal`s Shop';
        $this->load->view('website/shop/partial/_header', $data);
        $this->load->view('website/shop/partial/_navbar', $data);
        $this->load->view('website/shop/sales-offers', $data);
        $this->load->view('website/shop/partial/_footer', $data);
    }
	public function wishlist()
    {
        $data['title'] = 'Shantal`s Shop';
        $this->load->view('website/shop/partial/_header', $data);
        $this->load->view('website/shop/partial/_navbar', $data);
        $this->load->view('website/shop/wishlist', $data);
        $this->load->view('website/shop/partial/_footer', $data);
    }
	public function product_details(){
        $product_id = $this->cipher->decrypt($this->input->get('id', true));
        $data['product'] = $this->product_model->get_row('product', array('product_id' => $product_id));
        $data['product_img'] = $this->product_model->get_result('product_img', array('product_id' => $product_id));

		$data['title'] = 'Shantal`s Shop';
        $this->load->view('website/shop/partial/_header', $data);
		$this->load->view('website/shop/partial/_navbar', $data);
        $this->load->view('website/shop/product-details', $data);
        $this->load->view('website/shop/partial/_footer', $data);
	}
	public function checkout(){
        $cart_ids_encrypted = $this->input->get('product');
        $cart_ids_array = explode(',', $cart_ids_encrypted);
        $cart_ids_decrypted = [];

        foreach ($cart_ids_array as $cart_id_encrypted) {
            // URL decode and then decrypt each cart_id
            $cart_id_encrypted = urldecode($cart_id_encrypted);
            $cart_ids_decrypted[] = $this->cipher->decrypt($cart_id_encrypted);
        }
        if (!empty($cart_ids_decrypted)) {
            $cart_data = $this->product_model->get_cart_data($cart_ids_decrypted);
            $data['cart_items'] = $cart_data;
        }

        $data['delivery_address'] = $this->product_model->get_default_address();
        $data['province'] = $this->db->order_by("code = '133900000' DESC, name ASC")->get('psgc_province')->result();
		$data['title'] = 'Shantal`s Shop';
        $this->load->view('website/shop/partial/_header', $data);
        $this->load->view('website/shop/checkout', $data);
        $this->load->view('website/shop/partial/_footer', $data);
	}
	public function profile() {
        $data['profile'] = $this->main_model->get_row('user_details', array('user_id' => $this->session->userdata('customerIn')['user_id'], 'status' => 0));
        $data['province'] = $this->db->order_by("code = '133900000' DESC, name ASC")->get('psgc_province')->result();
        
		$data['title'] = 'Shantal`s Shop';
        $this->load->view('website/shop/partial/_header', $data);
		$this->load->view('website/shop/partial/_navbar', $data);
        $this->load->view('website/shop/profile', $data);
        $this->load->view('website/shop/partial/_footer', $data);
	}

    // Error 404 redirect
	public function page404()
	{
		$this->load->view('error404');
	}

    public function csrf()
    {
        $data["csrf_hash"] = $this->security->get_csrf_hash(TRUE); // Set $regenerate to TRUE to generate a new hash
        echo json_encode($data);
    }
}
//End CI_Controller