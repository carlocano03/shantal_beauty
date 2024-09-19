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

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
    } //End __construct

    public function index()
    {
        $data['title'] = 'Shantal`s Shop';
        $this->load->view('website/shop/partial/_header', $data);
        $this->load->view('website/shop/index', $data);
        $this->load->view('website/shop/partial/_footer', $data);
    }
	public function product_details(){
        $product_id = $this->cipher->decrypt($this->input->get('id', true));
        $data['product'] = $this->product_model->get_row('product', array('product_id' => $product_id));
        $data['product_img'] = $this->product_model->get_result('product_img', array('product_id' => $product_id));

		$data['title'] = 'Shantal`s Shop';
        $this->load->view('website/shop/partial/_header', $data);
        $this->load->view('website/shop/product-details', $data);
        $this->load->view('website/shop/partial/_footer', $data);
	}
	public function checkout(){
		$data['title'] = 'Shantal`s Shop';
        $this->load->view('website/shop/partial/_header', $data);
        $this->load->view('website/shop/checkout', $data);
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