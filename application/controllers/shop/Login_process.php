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

class Login_process extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('language');
        $this->lang->load('common','english');
        $this->load->model('shop/main_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
    } //End __construct

    public function signup_user()
    {
        $success = '';
        $error = '';

        $full_name = $this->input->post('full_name', true);
        $complete_address = $this->input->post('complete_address', true);
        $contact_no = $this->input->post('contact_no', true);
        $email_address = $this->input->post('email_address', true);
        $password = $this->input->post('password', true);
        $otp_no = mt_rand(100000, 999999);

        $check_email = $this->main_model->check_email_address($email_address);
        if ($check_email->num_rows() > 0) {
            $error = 'Email address already exist.';
        } else {
            $insert_details = array(
                'full_name'             => $full_name,
                'complete_address'      => $complete_address,
                'mobile_number'         => $contact_no,
                'email_address'         => $email_address,
                'email_verification'    => 'For Verification',
                'date_created'          => date('Y-m-d H:i:s'),
            );
            $user_details_id = $this->main_model->signup_user($insert_details);
            if ($user_details_id != '') {
                //Insert User account
                $customer_account = array(
                    'user_type_id'      => CUSTOMER,
                    'username'          => $email_address,
                    'password'          => password_hash($password, PASSWORD_DEFAULT),
                    'temp_password'     => '',
                    'date_created'      => date('Y-m-d H:i:s'),
                );
                $user_id = $this->main_model->insert_user_acct($customer_account);
                $this->main_model->update_user_details($user_id, $user_details_id);

                //Insert OTP
                $insert_otp = array(
                    'otp_no' => $otp_no,
                    'email_address' => $email_address,
                    'expiration_time' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
                );
                $this->main_model->insert_otp_no($insert_otp);

                //Send Email OTP
                // $mail_data = [
                //     'name_to' => $full_name,
                //     'otp_no'  => $otp_no,
                // ];

                // $this->send_email_html([
                //     'mail_to'       => $email_address,
                //     'cc'            => [],
                //     'subject'       => 'Your One-Time Password (OTP) for Account Verification',
                //     'template_path' => 'email_template/email_otp',
                //     'mail_data'     => $mail_data,
                // ]);

                $success = 'Customer account successfully created.';
            } else {
                $error = 'Failed to save the data.';
            }
        }
        $output = array(
            'success' => $success,
            'error' => $error,
            'user_details_id' => $user_details_id,
            'email_address' => $email_address,
        );
        echo json_encode($output);
    }

    public function verify_account()
    {
        $success = '';
        $error = '';

        $otp_no = $this->input->post('otp_no', true);
		$email_address = $this->input->post('email_address', true);
        $user_details_id = $this->input->post('user_details_id', true);

        $checkOTP = $this->main_model->check_otp($otp_no, $email_address);
        if ($checkOTP->num_rows() > 0) {
            $checkExpiration = $this->main_model->check_expiration($otp_no, $email_address);
            if ($checkExpiration->num_rows() > 0) {
                $update_otp = array(
					'otp_status' => 1,
				);
                $result = $this->main_model->update_otp($update_otp, $otp_no, $email_address);
                if ($result == TRUE) {
                    $this->main_model->update_user_verification($user_details_id);
					$success = 'Customer account successfully verified.';
				} else {
					$error = 'Failed to verify the customer account.';
				}
            } else {
                $update_otp = array(
					'otp_status' => 2,
				);
				$this->main_model->update_otp($update_otp, $otp_no, $email_address);
				$error = 'OTP number already expired.';
            }
        } else {
            $error = '<div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>Invalid OTP number.</div>';
        }
        $output = array(
            'success' => $success,
            'error' => $error,
        );
        echo json_encode($output);
    }

    public function login()
    {
        $success = '';
        $error = '';
        $main_url = '';
        $username = trim($this->input->post('username', true));
        $password = trim($this->input->post('password', true));

        $session = $this->main_model->user_check($username, $password);
        $userCheck = $this->main_model->userCheck($username);

        if ($userCheck > 0) {
            if ($session) {
                if ($session['is_active'] == 1) {
                    $error = '<div class="alert alert-danger"><i class="fas fa-info-circle me-2"></i>Your account is deactivated.</div>';
                } elseif ($session['status'] == 1) {
                    $error = '<div class="alert alert-danger"><i class="fas fa-info-circle me-2"></i>Your account is already deleted.</div>';
                } else {
                    $user_details = $this->main_model->get_user_details($session['user_id']);

                    $sess_array = array(
                        'user_id'       => $user_details['user_id'],
                        'user_type_id'  => $session['user_type_id'],
                        'fullname'      => $user_details['full_name'],
                        'email_add'     => $user_details['email_address'],
                        'user_details_id' => $user_details['user_details_id'],
                    );
                    $this->session->set_userdata('customerIn', $sess_array);
                    $main_url = base_url('shop');

                    $success = '<div class="alert alert-success"><i class="fas fa-info-circle me-2"></i>Please wait redirecting...</div>';
                }
            } else {
                $error = '<div class="alert alert-danger"><i class="fas fa-info-circle me-2"></i>Invalid password!</div>';
            }
        } else {
            $error = '<div class="alert alert-danger"><i class="fas fa-info-circle me-2"></i>Invalid username/email!</div>';
        }

        $output = array(
            'success' => $success,
            'error' => $error,
            'main_url' => $main_url,
        );
        echo json_encode($output);
    }

    public function logout($session)
    {
        $this->session->unset_userdata($session);
        redirect('');
    }

}