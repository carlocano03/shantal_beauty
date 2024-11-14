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

class News_management extends MY_Controller
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
        $this->load->model('admin_portal/news_management_model', 'news_management');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('adminIn', 'admin/login');
    } //End __construct

    public function add_news()
    {
        $error = '';
        $success = '';

        $news_title = $this->input->post('news_title', true);
        $news_link = $this->input->post('news_link', true);
        $news_image = $this->upload_news_image();
        $news_content = $this->input->post('news_content', true);

        // $checkNews = $this->news_management->check_existing_news($news_title);
        // if($checkNews > 0) {
        //     $error = 'News already exist.';
        // } else {
        //     $insert_news = array(
        //         'user_id'       => $this->session->userdata('adminIn')['user_id'],
        //         'news_title'    => $news_title,
        //         'news_link'     => $news_link,
        //         'content'       => $news_content,
        //         'news_image'    => $news_image,
        //         'date_created'  => date('Y-m-d H:i:s')
        //     );
        //     $result = $this->news_management->insert_news($insert_news);
        //     if ($result == TRUE) {
        //         $success = 'News successfully added.';
        //     } else {
        //         $error = 'Failed to add a news.';
        //     }
        // }
        $insert_news = array(
            'user_id'       => $this->session->userdata('adminIn')['user_id'],
            'news_title'    => $news_title,
            'news_link'     => $news_link,
            'content'       => $news_content,
            'news_image'    => $news_image,
            'date_created'  => date('Y-m-d H:i:s')
        );
        $result = $this->news_management->insert_news($insert_news);
        if ($result == TRUE) {
            $success = 'News successfully added.';
        } else {
            $error = 'Failed to add a news.';
        }
        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }

    private function upload_news_image()
    {
        if (isset($_FILES["news_image"])) {
            $dt = Date('His'); // Current time for unique filename
            $extension = pathinfo($_FILES['news_image']['name'], PATHINFO_EXTENSION);
            $new_name = rand() . '_' . $dt . '.' . $extension; // Randomize name for uniqueness
            $destination = 'assets/uploaded_file/news/' . $new_name;

            // Move the uploaded file
            if (move_uploaded_file($_FILES['news_image']['tmp_name'], $destination)) {
                return $new_name; // Return the new file name
            } else {
                return ''; // Return empty string if file upload failed
            }
        }
        return ''; // No file uploaded
    }

    public function get_news_list()
    {
        $news = $this->news_management->get_news_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($news as $list) {
            $no++;
            $row = array();

            $news_id = $this->cipher->encrypt($list->news_id);

            $row[] = $no;
            $row[] = ucwords($list->news_title);
            $row[] = $list->posted_by;
            $row[] = date('D M j, Y H:i A', strtotime($list->date_created));

            $action_btn = '<div class="btn-group">
                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="'.base_url('admin/manage-news/view?id='.$news_id).'" class="dropdown-item text-primary view_news"><i class="i bi-view-list me-2"></i>View News</a></li>
                                <li><a class="dropdown-item link-cursor text-danger delete_news" id="'.$list->news_id.'"><i class="bi bi-trash3-fill me-2"></i>Delete News</a></li>
                            </ul>
                        </div>';

            $row[] = $action_btn;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->news_management->count_all(),
            "recordsFiltered" => $this->news_management->count_filtered(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }
}