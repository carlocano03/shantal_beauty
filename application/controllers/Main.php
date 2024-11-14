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
        $this->lang->load('common','english');
        $this->load->library('cipher');
        $this->load->model('website/news_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
    } //End __construct

    public function index()
    {
        $data['title'] = 'Shantal`s Shop';
        $this->load->view('website/partial/_header', $data);
        $this->load->view('website/home', $data);
        $this->load->view('website/partial/_footer', $data);
    }

	public function products()
    {
        $data['title'] = 'Shantal`s Shop';
        $this->load->view('website/partial/_header', $data);
        $this->load->view('website/products', $data);
        $this->load->view('website/partial/_footer', $data);
    }
	public function news()
    {
        $data['title'] = 'Shantal`s Shop';
        $this->load->view('website/partial/_header', $data);
        $this->load->view('website/news', $data);
        $this->load->view('website/partial/_footer', $data);
    }
	public function news_detail()
    {
        $news_id = $this->cipher->decrypt($this->input->get('id'));

        $data['news'] = $this->news_model->get_news_details($news_id);
        $data['title'] = 'Shantal`s Shop';
        $this->load->view('website/partial/_header', $data);
        $this->load->view('website/news-detail', $data);
        $this->load->view('website/partial/_footer', $data);

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