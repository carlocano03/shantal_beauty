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

class Registration_form extends MY_Controller
{
	private $counter_application = SCHOLARSHIP_APP;
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('language');
        $this->lang->load('common','english');
        $this->load->model('website/registration_form_model');
		$this->load->model('system_counter_generator_model', 'system_counter');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
    } //End __construct

    public function index()
    {
        $data['title'] = 'CLCC | Scholarship Form';
        $data['header_contents'] = array(
            '<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/registration.css').'">',
            '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">',
            '<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>',
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );

		$data['deadline'] = $this->registration_form_model->get_deadline_filling();
		$data['citizenship'] = $this->registration_form_model->get_citizenship();
		$data['civil_status'] = $this->registration_form_model->get_civil_status();
        $this->load->view('website/partial/_header', $data);
        $this->load->view('website/registration_form', $data);
        $this->load->view('website/partial/_footer', $data);
    }

	public function success_registration()
	{
		$data['title'] = 'CLCC | Success Registration';
        $data['header_contents'] = array(
            '<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/registration.css').'">',
            '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">',
            '<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>',
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );

        $this->load->view('website/partial/_header', $data);
        $this->load->view('website/success_registration', $data);
	}

	public function check_existing_email()
	{
		$email_address = $this->input->post('email_address', true);
		$checkStudentEmail = $this->registration_form_model->check_student_email($email_address);

		$output = array(
			'email_address' => $checkStudentEmail->num_rows(),
		);

		echo json_encode($output);
	}

    public function send_email_otp()
    {
        $message = '';
		$otp_no = mt_rand(100000, 999999);
		$email_address = $this->input->post('email_address', true);

        $insert_otp = array(
			'otp_no' => $otp_no,
			'email_address' => $email_address,
			'expiration_time' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
		);
        $result = $this->registration_form_model->insert_otp_no($insert_otp);
        if ($result == TRUE) {
            // //Send email OTP
			$mail_data = [
				'name_to' => $this->input->post('firstname', true),
				'otp_no'  => $otp_no,
			];

            $this->send_email_html([
				'mail_to'       => $email_address,
				'cc'            => [],
				'subject'       => 'Your One-Time Password (OTP) for Account Verification',
				'template_path' => 'email_template/email_otp',
				'mail_data'     => $mail_data,
			]);

            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output = array(
			'message' => $message,
		);
		echo json_encode($output);
    }

    public function verify_email_otp()
	{
		$message = '';
		$otp_no = $this->input->post('otp_no', true);
		$email_address = $this->input->post('email_address', true);

		$checkOTP = $this->registration_form_model->check_otp($otp_no, $email_address);
		if ($checkOTP->num_rows() > 0) {

			$checkExpiration = $this->registration_form_model->check_expiration($otp_no, $email_address);
			if ($checkExpiration->num_rows() > 0) {
				$update_otp = array(
					'otp_status' => 1,
				);
				$result = $this->registration_form_model->update_otp($update_otp, $otp_no, $email_address);
				if ($result == TRUE) {
					$message = 'Success';
				} else {
					$message = 'Error';
				}
			} else {
				$update_otp = array(
					'otp_status' => 2,
				);
				$this->registration_form_model->update_otp($update_otp, $otp_no, $email_address);
				$message = 'Expired';
			}
		} else {
			$message = 'No Data';
		}
		$output = array(
			'message' => $message,
		);
		echo json_encode($output);
	}

	
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

	function calculate_age($birthday)
	{
		// Create a DateTime object from the birthday
		$birthDate = new DateTime($birthday);
		// Get the current date
		$today = new DateTime('today');
		// Calculate the difference between today and the birthdate
		$age = $birthDate->diff($today)->y;
		
		return $age;
	}

	public function scholarship_registration()
	{
		$error = '';
		$success = '';

		$application_no = $this->system_counter->get_ctrl_num_cv($this->counter_application);
		$school_name = $this->input->post('school_name', true);
		$student_first_name = $this->input->post('student_first_name', true);
		$student_middle_name = $this->input->post('student_middle_name', true);
		$student_last_name = $this->input->post('student_last_name', true);
		$student_no = $this->input->post('student_no', true);
		$course = $this->input->post('course', true);
		$year_level = $this->input->post('year_level', true);
		$birth_place = $this->input->post('birth_place', true);
		$birthday = $this->input->post('birthday', true);
		$age = $this->calculate_age($birthday);
		$citizenship = $this->input->post('citizenship', true);
		$civil_status = $this->input->post('civil_status', true);
		$permanent_address = $this->input->post('permanent_address', true);
		$pemanent_zipcode = $this->input->post('pemanent_zipcode', true);
		$permanent_tel_no = $this->input->post('permanent_tel_no', true);
		$city_address = $this->input->post('city_address', true);
		$city_zipcode = $this->input->post('city_zipcode', true);
		$city_tel_no = $this->input->post('city_tel_no', true);
		$school_address = $this->input->post('school_address', true);
		$mobile_no = $this->input->post('mobile_no', true);
		$email_address = $this->input->post('email_address', true);
		$father_fullname = $this->input->post('father_fullname', true);
		$father_occupation = $this->input->post('father_occupation', true);
		$father_salary = $this->input->post('father_salary', true);
		$mother_fullname = $this->input->post('mother_fullname', true);
		$mother_occupation = $this->input->post('mother_occupation', true);
		$mother_salary = $this->input->post('mother_salary', true);
		$parents_unemployed = $this->input->post('parents_unemployed', true);
		$unemployed_income = $this->input->post('unemployed_income', true);
		$other_sources = $this->input->post('other_sources', true);
		$self_employed = $this->input->post('self_employed', true);
		$earning_per_year = $this->input->post('earning_per_year', true);
		$guardian_name = $this->input->post('guardian_name', true);
		$guardian_occupation = $this->input->post('guardian_occupation', true);
		$guardian_salary = $this->input->post('guardian_salary', true);
		$relation = $this->input->post('relation', true);
		$any_previleges_university = $this->input->post('any_previleges_university', true);
		$outside_university = $this->input->post('outside_university', true);
		$name_scholarship_amount = $this->input->post('name_scholarship_amount', true);
		$own_properties = $this->input->post('own_properties', true);
		$property_name = $this->input->post('property_name', true);
		$market_value = $this->input->post('market_value', true);
		$property_others = $this->input->post('property_others', true);
		$parents_separated = $this->input->post('parents_separated', true);
		$married_separated = $this->input->post('married_separated', true);
		$giving_amount = $this->input->post('giving_amount', true);
		$personal_photo = $this->upload_attachment('personal_photo', 'assets/uploaded_attachment/personal_photo');
		$already_enrolled = $this->input->post('already_enrolled', true);
		$form_five = $this->upload_attachment('form_five', 'assets/uploaded_attachment/form_five');
		$copy_of_grade = $this->upload_attachment('copy_of_grade', 'assets/uploaded_attachment/copy_grade');
		$certification_year_level = $this->upload_attachment('certification_year_level', 'assets/uploaded_attachment/certification_year_level');
		$transcript_of_record = $this->upload_attachment('transcript_of_record', 'assets/uploaded_attachment/tor');
		$good_moral = $this->upload_attachment('good_moral', 'assets/uploaded_attachment/good_moral');
		$birth_certificate = $this->upload_attachment('birth_certificate', 'assets/uploaded_attachment/birth_certificate');
		$letter_recommendation = $this->upload_attachment('letter_recommendation', 'assets/uploaded_attachment/letter_recommendation');

		$check_student = $this->registration_form_model->check_existing_student($student_first_name, $student_last_name, $birthday);
		if ($check_student->num_rows() > 0) {
			$error = 'Student already exist.';
		} else {
			$insert_registration = array(
				'application_no'			=> $application_no,
				'school_name'				=> $school_name,
				'student_first_name'		=> $student_first_name,
				'student_middle_name'		=> $student_middle_name,
				'student_last_name'			=> $student_last_name,
				'student_no'				=> $student_no,
				'course'					=> $course,
				'year_level'				=> $year_level,			
				'birth_place'				=> $birth_place,	
				'birthday'					=> $birthday,
				'age'						=> $age,
				'citizenship'				=> $citizenship,
				'civil_status'				=> $civil_status,
				'permanent_address'			=> $permanent_address,
				'pemanent_zipcode'			=> $pemanent_zipcode,
				'permanent_tel_no'			=> $permanent_tel_no,
				'city_address'				=> $city_address,
				'city_zipcode'				=> $city_zipcode,
				'city_tel_no'				=> $city_tel_no,
				'school_address'			=> $school_address,
				'mobile_no'					=> $mobile_no,
				'email_address'				=> $email_address,
				'father_fullname'			=> $father_fullname,
				'father_occupation'			=> $father_occupation,
				'father_salary'				=> str_replace(',','', $father_salary),
				'mother_fullname'			=> $mother_fullname,
				'mother_occupation'			=> $mother_occupation,
				'mother_salary'				=> str_replace(',','', $mother_salary),
				'parents_unemployed'		=> $parents_unemployed,
				'unemployed_income'			=> str_replace(',','', $unemployed_income),
				'other_sources'				=> $other_sources,
				'self_employed'				=> $self_employed,
				'earning_per_year'			=> str_replace(',','', $earning_per_year),
				'guardian_name'				=> $guardian_name,
				'guardian_occupation'		=> $guardian_occupation,
				'guardian_salary'			=> str_replace(',','', $guardian_salary),
				'relation'					=> $relation,
				'any_previleges_university'	=> $any_previleges_university,
				'outside_university'		=> $outside_university,
				'name_scholarship_amount'	=> $name_scholarship_amount,
				'own_properties'			=> $own_properties,
				'property_name'				=> $property_name,
				'market_value'				=> $market_value,
				'property_others'			=> $property_others,
				'parents_separated'			=> $parents_separated,
				'married_separated'			=> $married_separated,
				'giving_amount'				=> str_replace(',','', $giving_amount),
				'personal_photo'			=> $personal_photo,
				'already_enrolled'			=> $already_enrolled,
				'form_five'					=> $form_five,
				'copy_of_grade'				=> $copy_of_grade,
				'certification_year_level'	=> $certification_year_level,
				'transcript_of_record'		=> $transcript_of_record,
				'good_moral'				=> $good_moral,
				'birth_certificate'			=> $birth_certificate,
				'letter_recommendation'		=> $letter_recommendation,
				'date_application'			=> date('Y-m-d H:i:s'),
				'application_status'		=> 'For Approval',
			);

			$result = $this->registration_form_model->insert_scholarship_registration($insert_registration);
			if ($result == TRUE) {

				//Send email
				$mail_data = [
					'name_to' => $student_first_name,
				];

				$this->send_email_html([
					'mail_to'       => $email_address,
					'cc'            => [],
					'subject'       => 'Scholarship Application [For Approval]',
					'template_path' => 'email_template/success_registration',
					'mail_data'     => $mail_data,
				]);
				$this->system_counter->increment_ctrl_num($this->counter_application);
				$success = 'Scholarship application successfully submitted.';
			} else {
				$error = 'Failed to save the application.';
			}
		}

		$output = array(
			'error' => $error,
			'success' => $success,
		);
		echo json_encode($output);
	}

}
