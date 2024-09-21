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

class Reseller_application extends MY_Controller
{
    private $counter_reseller = RESELLER;
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('language');
        $this->load->library('cipher');
        $this->lang->load('common','english');
        $this->load->model('admin_portal/reseller_application_model', 'reseller_application');
        $this->load->model('system_counter_generator_model', 'system_counter');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('adminIn', 'admin/login');
    } //End __construct

    public function get_reseller_application()
    {
        $reseller = $this->reseller_application->get_reseller_application();
        $data = array();
        $no = $_POST['start'];
        foreach ($reseller as $list) {
            $no++;
            $row = array();

            $fullname = $list->last_name.', '.$list->first_name;
            $application_id = $this->cipher->encrypt($list->application_id);

            $row[] = $no;
            $row[] = $list->application_no;
            $row[] = ucwords($fullname);
            $row[] = date('D M j, Y h:i A', strtotime($list->date_created));

            $stageColors = array(
                'For Validation' => 'bg-warning',
                'Approved' => 'bg-success',
                'Declined' => 'bg-danger',
            );
            $color = array_key_exists($list->request_status, $stageColors) ? $stageColors[$list->request_status] : 'bg-secondary';
            $row[] = '<div class="badge '.$color.'">'.$list->request_status.'</div>';

            $row[] = '<div class="btn-group">
                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li><a target="_blank" href="'.base_url('admin/reseller-application/information?application=').$application_id.'" class="dropdown-item link-cursor text-primary"><i class="bi bi-view-list me-2"></i>View Request</a></li>
                        </ul>
                    </div>';

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->reseller_application->count_all(),
            "recordsFiltered" => $this->reseller_application->count_filtered(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

    public function approval_reseller_application()
    {
        $success = '';
        $error = '';

        $application_id = $this->input->post('application_id', true);
        $action = $this->input->post('action', true);

        $data = $this->reseller_application->get_row('reseller_application', array('application_id' => $application_id, 'status' => 0));

        if ($action == 'Approve') {
            $reseller_no = $this->system_counter->get_ctrl_num_cv($this->counter_reseller);
            $generated_referral = $this->generateReferralCode();

            $insert_reseller = array(
                'reseller_no'       => $reseller_no,
                'first_name'        => $data['first_name'],
                'last_name'         => $data['last_name'],
                'email_address'     => $data['email_address'],
                'street'            => $data['street'],
                'barangay'          => $data['barangay'],
                'municipality'      => $data['municipality'],
                'province'          => $data['province'],
                'phone_number'      => $data['phone_number'],
                'referral_code'     => $generated_referral,
                'referred_by'       => $data['referral_code'],
                'type_id'           => $data['type_id'],
                'id_attachment'     => $data['id_attachment'],
                'tin_no'            => $data['tin_no'],
                'bank_type'         => $data['bank_type'],
                'bank_name'         => $data['bank_name'],
                'account_number'    => $data['account_number'],
                'confirmation_age'  => $data['confirmation_age'],
                'date_created'      => date('Y-m-d H:i:s'),
            );

            $reseller_id = $this->reseller_application->insert_reseller_details($insert_reseller);
            if ($reseller_id != '') {

                if ($data['referral_code'] != '') {
                    $referral = $this->reseller_application->check_existing_referral($data['referral_code']);
                    if ($referral) {
                        //Insert Referral Info
                        $referral_info = array(
                            'reseller_id'   => $referral->reseller_id,
                            'referral_code' => $data['referral_code'],
                            'remarks'       => 'Reseller',
                            'date_created'  => date('Y-m-d H:i:s'),
                        );
                        $this->db->insert('referral_info', $referral_info);
                    }
                }

                $this->system_counter->increment_ctrl_num($this->counter_reseller);
                $this->reseller_application->update_reseller_application($application_id);

                $password = $this->generateRandomString();
                $reseller_account = array(
                    'user_type_id'      => RESELLER_USER,
                    'username'          => $reseller_no,
                    'password'          => password_hash($password, PASSWORD_DEFAULT),
                    'temp_password'     => $password,
                    'date_created'      => date('Y-m-d H:i:s'),
                );
                $user_id = $this->reseller_application->insert_user_acct($reseller_account);
                $this->reseller_application->update_reseller_details($user_id, $reseller_id);

                //Send email
                // $mail_data = [
                //     'name_to'   => $data['first_name'],
                //     'login_url' => base_url(),
                //     'username'  => $reseller_no,
                //     'password'  => $password,
                // ];

                // $this->send_email_html([
                //     'mail_to'       => $data['email_address'],
                //     'cc'            => [],
                //     'subject'       => 'Congratulations [Reseller Application Approved]',
                //     'template_path' => 'email_template/approved_request',
                //     'mail_data'     => $mail_data,
                // ]);

                $success = 'Application successfully approved.';
            } else {
                $error = 'Failed to update the data.';
            }
        } else {
            //Declined
            $comment = $this->input->post('comment', true);
            $decline_application = array(
                'request_status' => 'Declined',
                'decline_comment' => $comment,
            );

            $result = $this->reseller_application->decline_application($decline_application, $application_id);
            if ($result == TRUE) {
                //Send email
                // $mail_data = [
                // 	'name_to' => $data['first_name'],
                //     'comment' => $comment,
                // ];

                // $this->send_email_html([
                // 	'mail_to'       => $data['email_address'],
                // 	'cc'            => [],
                // 	'subject'       => 'Reseller Application [Declined]',
                // 	'template_path' => 'email_template/declined_request',
                // 	'mail_data'     => $mail_data,
                // ]);

                $success = 'Application successfully declined.';
            } else {
                $error = 'Failed to update the data.';
            }
        }
        $output = array(
            'success' => $success,
            'error' => $error,
        );
        echo json_encode($output);
    }

    private function generateRandomString($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function generateReferralCode($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    //=======================Reseller account============================
    public function get_reseller_account()
    {
        $reseller = $this->reseller_application->get_reseller_account();
        $data = array();
        $no = $_POST['start'];
        foreach ($reseller as $list) {
            $no++;
            $row = array();

            $fullname = $list->last_name.', '.$list->first_name;
            $reseller_id = $this->cipher->encrypt($list->reseller_id);

            $row[] = $no;
            $row[] = $list->reseller_no;
            $row[] = ucwords($fullname);
            $row[] = $list->email_address;
            $row[] = date('D M j, Y h:i A', strtotime($list->date_created));
            $row[] = $list->referral_code;

            $row[] = '<div class="btn-group">
                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li><a target="_blank" href="'.base_url('admin/reseller-account/information?id=').$reseller_id.'" class="dropdown-item link-cursor text-primary"><i class="bi bi-view-list me-2"></i>View Details</a></li>
                            <li><a class="dropdown-item link-cursor text-danger update_modal" 
                                data-id="'.$list->reseller_id.'"
                            ><i class="bi bi-pencil-square me-2"></i>Update Status</a></li>
                        </ul>
                    </div>';

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->reseller_application->count_all_reseller(),
            "recordsFiltered" => $this->reseller_application->count_filtered_reseller(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

    public function get_reseller_count()
    {
        $active = $this->reseller_application->get_reseller_count(0);
        $inactive = $this->reseller_application->get_reseller_count(1);

        $output = array(
            'active_reseller' => number_format($active),
            'inactive_reseller' => number_format($inactive),
        );
        echo json_encode($output);
    }

    public function update_reseller_status()
    {
        $success = '';
        $error = '';

        $reseller_id = $this->input->post('reseller_id', true);
        $reseller_status = $this->input->post('reseller_status', true);

        $update_status = array(
            'date_updated' => date('Y-m-d H:i:s'),
            'status'       => $reseller_status,
        );

        $result = $this->reseller_application->update_reseller_status($reseller_id, $update_status);
        if ($result == TRUE) {
            $success = 'Reseller status successfully updated.';
        } else {
            $error = 'Failed to update the data.';
        }
        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }

    //==========================Voucher=============================
    public function get_voucher_list()
    {
        $voucher = $this->reseller_application->get_voucher_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($voucher as $list) {
            $no++;
            $row = array();

            $row[] = $no;
            $row[] = '<div>'.ucwords($list->reseller_name).'</div>
                      <span style="font-size:10px; color:red; font-weight:600;">Reseller No.: '.ucwords($list->reseller_no).'</span>';
            $row[] = '<div>'.$list->voucher_code.'</div>';
            $row[] = date('D M j, Y h:i A', strtotime($list->date_created));
            $row[] = date('F j, Y', strtotime($list->end_date));

            $stageColors = array(
                'For Approval' => 'bg-warning',
                'Approved' => 'bg-success',
                'Declined' => 'bg-danger',
            );
            if ($list->request_status == 'Declined') {
                $remarks = '<div style="font-size:10px; color:red;;">'.ucfirst($list->decline_comment).'</div>';
            } else {
                $remarks = '';
            }
            $color = array_key_exists($list->request_status, $stageColors) ? $stageColors[$list->request_status] : 'bg-secondary';
            $row[] = '<div class="badge '.$color.'">'.$list->request_status.'</div>
                      '.$remarks.'';

            if ($list->request_status != 'For Approval') {
                $disabled = 'disabled';
            } else {
                $disabled = '';
            }
            $action_btn = '<div class="btn-group">
                            <button '.$disabled.' type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item link-cursor text-primary view_modal"
                                    data-id="'.$list->voucher_id.'"
                                    data-voucher_code="'.$list->voucher_code.'"
                                    data-desc="'.$list->description.'"
                                    data-amt="'.number_format($list->voucher_amt,2).'"
                                    data-end_date="'.date('F j, Y', strtotime($list->end_date)).'"
                                ><i class="bi bi-view-list me-2"></i>View Details</a></li>
                            </ul>
                        </div>';

            $row[] = $action_btn;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->reseller_application->count_all_voucher(),
            "recordsFiltered" => $this->reseller_application->count_filtered_voucher(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

    public function voucher_approval()
    {
        $success = '';
        $error = '';
        $voucher_id = $this->input->post('voucher_id', true);
        $approval_remarks = $this->input->post('approval_remarks', true);

        switch ($approval_remarks) {
            case 'Approved':
                $update_voucher = array(
                    'request_status' => 'Approved',
                );
                break;
            
            case 'Declined':
                $update_voucher = array(
                    'request_status' => 'Declined',
                    'decline_comment' => $this->input->post('comment', true),
                );
                break;
        }
        $result = $this->reseller_application->voucher_approval($update_voucher, $voucher_id);
        if ($result == TRUE) {
            $success = 'Voucher successfully '.strtolower($approval_remarks);
        } else {
            $error = 'Failed to update the voucher';
        }
        $output = array(
            'success' => $success,
            'error' => $error,
        );
        echo json_encode($output);
    }

    //==========================End of Voucher=============================


}