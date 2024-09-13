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
    private $counter_application = RESELLER_APP;
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('language');
        $this->lang->load('common','english');
        $this->load->model('website/reseller_application_model');
        $this->load->model('system_counter_generator_model', 'system_counter');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
    } //End __construct

    private function upload_attachment($input_name, $destination_dir)
	{
		if (isset($_FILES[$input_name]))
		{
			$dt = date('His');
			$extension = pathinfo($_FILES[$input_name]['name'], PATHINFO_EXTENSION);
			$new_name = rand() . '_' . $dt . '.' . $extension;
			$destination = $destination_dir . '/' . $new_name;
			move_uploaded_file($_FILES[$input_name]['tmp_name'], $destination);
			return $new_name;
		} 
		return false; // Return false if no file was uploaded
	}

    public function save_application()
    {
        $success = '';
        $error = '';

        $application_no = $this->system_counter->get_ctrl_num_cv($this->counter_application);

        $firstName = $this->input->post('firstName', true);
        $lastName = $this->input->post('lastName', true);
        $signupEmail = $this->input->post('signupEmail', true);
        $streetAddress = $this->input->post('streetAddress', true);
        $brgyAddress = $this->input->post('brgyAddress', true);
        $city = $this->input->post('city', true);
        $stateProvince = $this->input->post('stateProvince', true);
        $phoneNumber = $this->input->post('phoneNumber', true);
        $signupReferralCode = $this->input->post('signupReferralCode', true);
        $typeOfId = $this->input->post('typeOfId', true);
        $tin = $this->input->post('tin', true);
        $account_commission = $this->input->post('account_commission', true);
        $bank_name = $this->input->post('bank_name', true);
        $account_no = $this->input->post('account_no', true);
        $validId = $this->upload_attachment('validId', 'assets/uploaded_file/reseller_application');
        $age_confirmation = $this->input->post('age_confirmation', true);

        $insert_application = array(
            'application_no'    => $application_no,
            'first_name'        => $firstName,
            'last_name'         => $lastName,
            'email_address'     => $signupEmail,
            'street'            => $streetAddress,
            'barangay'          => $brgyAddress,
            'municipality'      => $city,
            'province'          => $stateProvince,
            'phone_number'      => $phoneNumber,
            'referral_code'     => $signupReferralCode,
            'type_id'           => $typeOfId,
            'id_attachment'     => $validId,
            'tin_no'            => $tin,
            'bank_type'         => $account_commission,
            'bank_name'         => $bank_name,
            'account_number'    => $account_no,
            'confirmation_age'  => $age_confirmation,
            'date_created'      => date('Y-m-d H:i:s'),
            'request_status'    => 'For Validation',
        );
        $result = $this->reseller_application_model->save_application($insert_application);
        if ($result == TRUE) {
            //Send email
		    // $mail_data = [
			//     'name_to' => $student_first_name,
		    // ];

		    // $this->send_email_html([
			//     'mail_to'       => $email_address,
			//     'cc'            => [],
			//     'subject'       => 'Scholarship Application [For Approval]',
			//     'template_path' => 'email_template/success_registration',
			//     'mail_data'     => $mail_data,
		    // ]);
		    $this->system_counter->increment_ctrl_num($this->counter_application);

            $success = 'Application successfully submitted.';
        } else {
            $error = 'Failed to save the application.';
        }
        $output = array(
			'error' => $error,
			'success' => $success,
		);
		echo json_encode($output);
    }

    public function track_application_status()
    {
        $error = '';
        $status = '';

        $referenceNumber = $this->input->post('referenceNumber', true);

        $check_existing = $this->reseller_application_model->check_existing($referenceNumber);
        if ($check_existing->num_rows() > 0) {
            $application = $check_existing->row_array();
            $status = '
                <table id="tbl_reference">
                    <tr>
                        <th colspan="2">'.$application['application_no'].'</th>
                    </tr>
                    <tbody>
                        <tr>
                            <td>'.$application['request_status'].'</td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            ';
        } else {
            $error = '<div class="alert alert-danger">Reference number not found.</div>';
        }
        $output = array(
			'error' => $error,
			'status' => $status,
		);
		echo json_encode($output);
    }

}