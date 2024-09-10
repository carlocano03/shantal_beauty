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

class Product_management extends MY_Controller
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

        $this->load->model('admin_portal/inventory/product_management_model', 'product_management');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        // $this->check_session('adminIn', 'login');
    } //End __construct

    private function upload_product_image()
    {
        if (isset($_FILES["cropped_image"])) {
            $dt = Date('His'); // Current time for unique filename
            $extension = pathinfo($_FILES['cropped_image']['name'], PATHINFO_EXTENSION);
            $new_name = rand() . '_' . $dt . '.' . $extension; // Randomize name for uniqueness
            $destination = 'assets/uploaded_file/uploaded_product/' . $new_name;

            // Move the uploaded file
            if (move_uploaded_file($_FILES['cropped_image']['tmp_name'], $destination)) {
                return $new_name; // Return the new file name
            } else {
                return ''; // Return empty string if file upload failed
            }
        }
        return ''; // No file uploaded
    }

    public function save_new_product()
    {
        $error = '';
        $success = '';
        $redirectLink = '';

        $product_name = preg_replace('/[^A-Za-z0-9\s]/', '', $this->input->post('product_name', true));
        $product_desc = preg_replace('/[^A-Za-z0-9\s,._-]/', '', $this->input->post('product_desc', true));
        $net_weight = $this->input->post('net_weight', true);
        $selling_price = str_replace(',','', $this->input->post('selling_price', true));
        $product_image = $this->upload_product_image();

        if ($product_image === '') {
            $error = 'Image upload failed.';
        } else {
            $check_existing_product = $this->product_management->check_existing_product($product_name);
            if ($check_existing_product->num_rows() > 0) {
                $error = 'Product name already exists.';
            } else {
                $insert_product = array(
                    'product_name'      => $product_name,
                    'description'       => $product_desc,
                    'net_weight'        => $net_weight,
                    'selling_price'     => $selling_price,
                    'main_product_img'  => $product_image,
                    'date_created'      => date('Y-m-d H:i:s'),
                );
                $product_id = $this->product_management->insert_new_product($insert_product);
                if ($product_id != '') {
                    $redirectLink = base_url('admin/product-management/stock-in?product=').$this->cipher->encrypt($product_id);
                    $success = 'New product successfully added';
                } else {
                    $error = 'Failed to add new product.';
                }
            }
        }
        $output = array(
            'error' => $error,
            'success' => $success,
            'redirectLink' => $redirectLink,
        );
        echo json_encode($output);
    }

    public function update_product()
    {
        $error = '';
        $success = '';

        $product_id = $this->input->post('product_id', true);
        $product_name = preg_replace('/[^A-Za-z0-9\s]/', '', $this->input->post('product_name', true));
        $product_desc = preg_replace('/[^A-Za-z0-9\s,._-]/', '', $this->input->post('product_desc', true));
        $net_weight = $this->input->post('net_weight', true);
        $selling_price = str_replace(',','', $this->input->post('selling_price', true));
        $options = $this->input->post('options', true);

        switch ($options) {
            case 'Info':
                $update_product = array(
                    'product_name'  => $product_name,
                    'description'   => $product_desc,
                    'net_weight'    => $net_weight,
                    'selling_price' => $selling_price,
                );
                $result = $this->product_management->update_product($update_product, $product_id);
                if ($result == TRUE) {
                    $success = 'Product successfully updated.';
                } else {
                    $error = 'Failed to update the product.';
                }
                break;
            
            case 'Image':
                $product_image = $this->upload_product_image();
                $product = $this->product_management->get_row('product', array('product_id' => $product_id, 'status' => 0));
                $old_image_path = $product['main_product_img'];

                $update_product = array(
                    'main_product_img'  => $product_image,
                );
                $result = $this->product_management->update_product($update_product, $product_id);
                if ($result == TRUE) {
                    if (!empty($old_image_path) && file_exists('./assets/uploaded_file/uploaded_product/' . $old_image_path)) {
                        unlink('./assets/uploaded_file/uploaded_product/' . $old_image_path);
                    }
                    $success = 'Product successfully updated.';
                } else {
                    $error = 'Failed to update the product.';
                }
                break;
        }
        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }

    public function get_lot_number()
    {
        $lot_number = $this->product_management->get_lot_number();
        $data = array();
        $no = $_POST['start'];
        foreach ($lot_number as $list) {
            $no++;
            $row = array();

            $row[] = $no;
            $row[] = $list->batch_lot_no;
            $row[] = date('F j, Y', strtotime($list->expiration_date));
            $row[] = number_format($list->stocks);

            $action = '
                <div class="btn-group">
                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu" style="">
                        <li><a class="dropdown-item link-cursor text-primary action_btn"
                            data-stock_id="'.$list->stock_id.'"
                            data-product_id="'.$list->product_id.'"
                            data-stock="'.$list->stocks.'"
                            data-lot="'.$list->batch_lot_no.'"
                            data-action="Add"
                        ><i class="bi bi-plus-square me-2"></i>Add Stock</a></li>
                        <li><a class="dropdown-item link-cursor text-danger action_btn"
                            data-stock_id="'.$list->stock_id.'"
                            data-product_id="'.$list->product_id.'"
                            data-stock="'.$list->stocks.'"
                            data-lot="'.$list->batch_lot_no.'"
                            data-action="Delete"
                        ><i class="bi bi-trash3-fill me-2"></i>Delete Stock</a></li>
                    </ul>
                </div>
            ';

            $row[] = $action;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->product_management->count_all_lot(),
            "recordsFiltered" => $this->product_management->count_filtered_lot(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

    public function stock_management()
    {
        $error = '';
        $success = '';

        $product_id = $this->input->post('product_id', true);
        $lot_number = $this->input->post('lot_number', true);
        $expiration_date = $this->input->post('expiration_date', true);
        $qty_in = $this->input->post('qty_in', true);
        $action = $this->input->post('action', true);

        switch ($action) {
            case 'Add':
                $check_existing_lot = $this->product_management->check_existing_lot($product_id, $lot_number);
                if ($check_existing_lot->num_rows() > 0) {
                    $error = 'Lot number is already exist on this product.';
                } else {
                    $insert_stocks = array(
                        'product_id'        => $product_id,
                        'batch_lot_no'      => $lot_number,
                        'expiration_date'   => $expiration_date,
                        'stocks'            => $qty_in,
                        'date_created'      => date('Y-m-d H:i:s'),
                    );
                    $stock_id = $this->product_management->add_stocks($insert_stocks);
                    if ($stock_id != '') {
                        //Insert history
                        $insert_stock_history = array(
                            'product_id'    => $product_id,
                            'stock_id'      => $stock_id,
                            'transaction'   => 'Stock-In',
                            'quantity'      => $qty_in,
                            'date_created'  => date('Y-m-d H:i:s'),
                        );
                        $this->product_management->insert_history($insert_stock_history);
                        $this->product_management->increment_stocks($product_id, $qty_in);
                        $success = 'Stock successfully added';
                    } else {
                        $error = 'Failed to add stock.';
                    }
                }
               
                break;
            
            case 'Update':
                # code...
                break;
        }

        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }

    public function update_stocks()
    {
        $error = '';
        $success = '';

        $stock_id = $this->input->post('stock_id', true);
        $product_id = $this->input->post('product_id', true);
        $stock = $this->input->post('stock', true);
        $action = $this->input->post('action', true);

        switch ($action) {
            case 'Add':
                $qty_in = $this->input->post('qty_in', true);
                $new_stock = $stock + $qty_in;
                $update_stock = array(
                    'stocks' => $new_stock,
                );
                $result = $this->product_management->update_stocks($update_stock, $stock_id);
                if ($result == TRUE) {
                    $this->product_management->increment_stocks($product_id, $qty_in);
                    //Insert history
                    $insert_stock_history = array(
                        'product_id'    => $product_id,
                        'stock_id'      => $stock_id,
                        'transaction'   => 'Stock-In',
                        'quantity'      => $qty_in,
                        'date_created'  => date('Y-m-d H:i:s'),
                    );
                    $this->product_management->insert_history($insert_stock_history);

                    $success = 'Stock successfully deleted.';
                } else {
                    $error = 'Failed to delete the stock.';
                }
                break;
            
            case 'Delete':
                $update_stock = array(
                    'status' => 1, //Deleted
                );
                $result = $this->product_management->update_stocks($update_stock, $stock_id);
                if ($result == TRUE) {
                    $this->product_management->decrement_stocks($product_id, $stock);
                    //Insert history
                    $insert_stock_history = array(
                        'product_id'    => $product_id,
                        'stock_id'      => $stock_id,
                        'transaction'   => 'Delete',
                        'quantity'      => $stock,
                        'date_created'  => date('Y-m-d H:i:s'),
                    );
                    $this->product_management->insert_history($insert_stock_history);

                    $success = 'Stock successfully deleted.';
                } else {
                    $error = 'Failed to delete the stock.';
                }
                break;
        }
        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }

    public function product_list()
    {
        $lot_number = $this->product_management->product_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($lot_number as $list) {
            $no++;
            $row = array();

            $product_id = $this->cipher->encrypt($list->product_id);

            $row[] = ucwords($list->product_name);
            $row[] = $list->net_weight;
            $row[] = number_format($list->selling_price);
            $row[] = number_format($list->available_stocks);
            
            if ($list->available_stocks > 0) {
                $status = '<span class="badge bg-success">With Stocks</span>';
            } else {
                $status = '<span class="badge bg-danger">No Stocks</span>';
            }

            $row[] = $status;
            $action = '
                <div class="btn-group">
                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu" style="">
                        <li><a href="'.base_url('admin/product-management/stock-in?product='.$product_id).'" class="dropdown-item link-cursor text-primary"><i class="bi bi-view-list me-2"></i>View Stocks</a></li>
                        <li><a class="dropdown-item link-cursor text-info update_modal"
                            data-product_id="'.$list->product_id.'"
                            data-product="'.$list->product_name.'"
                            data-desc="'.$list->description.'"
                            data-net_wt="'.$list->net_weight.'"
                            data-price="'.$list->selling_price.'"
                        ><i class="bi bi-pencil-square me-2"></i>Update Product</a></li>
                        <li><a class="dropdown-item link-cursor text-danger delete"><i class="bi bi-trash3-fill me-2"></i>Delete Product</a></li>
                    </ul>
                </div>
            ';

            $row[] = $action;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->product_management->count_all(),
            "recordsFiltered" => $this->product_management->count_filtered(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }
}