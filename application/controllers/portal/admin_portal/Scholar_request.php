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

class Scholar_request extends MY_Controller
{
    private $counter_member = SCHOLAR_MEMBER;
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('language');
        $this->lang->load('common','english');
        $this->load->library('cipher');
        $this->load->model('portal/admin_portal/scholar_request_model');
        $this->load->model('system_counter_generator_model', 'system_counter');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('adminIn', 'login');
    } //End __construct

    public function index()
    {
        $data['home_url'] = base_url('admin/portal');
        $data['active_page'] = 'scholarship_page';
        $data['card_title'] = 'Scholarship Approval';
        $data['icon'] = 'bi bi-person-vcard';
        $data['header_contents'] = array(
            '<link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" rel="stylesheet">',
            '<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>',
            '<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>',
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );
        $this->load->view('admin_portal/partial/_header', $data);
        $this->load->view('admin_portal/scholarship_request', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function scholar_information()
    {
        $application_id = $this->cipher->decrypt($this->input->get('application'));
        
        $data['application'] = $this->scholar_request_model->get_row('scholarship_application', array('application_id' => $application_id));
        $data['home_url'] = base_url('admin/portal');
        $data['active_page'] = 'scholarship_page';
        $data['card_title'] = 'Scholar Information';
        $data['icon'] = 'bi bi-person-vcard';
        $data['header_contents'] = array(
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );
        $this->load->view('admin_portal/partial/_header', $data);
        $this->load->view('admin_portal/scholar_information', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function get_scholar_list()
    {
        $scholar = $this->scholar_request_model->get_scholar_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($scholar as $list) {
            $no++;
            $row = array();

            $fullname = $list->student_last_name.', '.$list->student_first_name.' '.$list->student_middle_name;
            $application_id = $this->cipher->encrypt($list->application_id);

            $row[] = $no;
            $row[] = $list->application_no;
            $row[] = ucwords($fullname);
            $row[] = ucwords($list->school_name);
            $row[] = date('D M j, Y h:i A', strtotime($list->date_application));
            
            $stageColors = array(
                'For Approval' => 'bg-warning',
                'Approved' => 'bg-success',
                'Declined' => 'bg-danger',
            );
            $color = array_key_exists($list->application_status, $stageColors) ? $stageColors[$list->application_status] : 'bg-secondary';
            $row[] = '<div class="badge '.$color.'">'.$list->application_status.'</div>';
            $row[] = '<div class="btn-group">
                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li><a target="_blank" href="'.base_url('admin/scholarship-approval/scholar-information?application=').$application_id.'" class="dropdown-item link-cursor text-primary"><i class="bi bi-view-list me-2"></i>View Request</a></li>
                        </ul>
                    </div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->scholar_request_model->count_all(),
            "recordsFiltered" => $this->scholar_request_model->count_filtered(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

    public function download_attachment()
    {
        $this->load->helper('download');
        $filename = $_GET['file'];
        $folder = $_GET['folder'];
        $file_path = 'assets/uploaded_attachment/' . $folder . '/' . $filename;
        force_download($file_path, NULL);
    }

    public function approve_request()
    {
        $error = '';
        $success = '';

        $application_id = $this->input->post('application_id', true);
        $action = $this->input->post('action', true);
        $data = $this->scholar_request_model->get_row('scholarship_application', array('application_id' => $application_id));

        if ($action == 'Approved') {
            $check_student = $this->scholar_request_model->check_existing_student($data['student_first_name'], $data['student_last_name'], $data['birthday']);

            if ($check_student->num_rows() > 0) {
                $error = 'Scholar member already exist';
            } else {
                //Insert scholar member
                $scholarship_no = $this->system_counter->get_ctrl_num_cv($this->counter_member);

                $insert_member = array(
                    'scholarship_no'			=> $scholarship_no,
                    'school_name'				=> $data['school_name'],
                    'student_first_name'		=> $data['student_first_name'],
                    'student_middle_name'		=> $data['student_middle_name'],
                    'student_last_name'			=> $data['student_last_name'],
                    'student_no'				=> $data['student_last_name'],
                    'course'					=> $data['course'],
                    'year_level'				=> $data['year_level'],			
                    'birth_place'				=> $data['birth_place'],	
                    'birthday'					=> $data['birthday'],
                    'age'						=> $data['age'],
                    'citizenship'				=> $data['citizenship'],
                    'civil_status'				=> $data['civil_status'],
                    'permanent_address'			=> $data['permanent_address'],
                    'pemanent_zipcode'			=> $data['permanent_address'],
                    'permanent_tel_no'			=> $data['permanent_tel_no'],
                    'city_address'				=> $data['city_address'],
                    'city_zipcode'				=> $data['city_address'],
                    'city_tel_no'				=> $data['city_tel_no'],
                    'school_address'			=> $data['school_address'],
                    'mobile_no'					=> $data['mobile_no'],
                    'email_address'				=> $data['email_address'],
                    'father_fullname'			=> $data['father_fullname'],
                    'father_occupation'			=> $data['father_occupation'],
                    'father_salary'				=> $data['father_salary'],
                    'mother_fullname'			=> $data['mother_fullname'],
                    'mother_occupation'			=> $data['mother_occupation'],
                    'mother_salary'				=> $data['mother_salary'],
                    'parents_unemployed'		=> $data['parents_unemployed'],
                    'unemployed_income'			=> $data['unemployed_income'],
                    'other_sources'				=> $data['other_sources'],
                    'self_employed'				=> $data['self_employed'],
                    'earning_per_year'			=> $data['earning_per_year'],
                    'guardian_name'				=> $data['guardian_name'],
                    'guardian_occupation'		=> $data['guardian_occupation'],
                    'guardian_salary'			=> $data['guardian_salary'],
                    'relation'					=> $data['relation'],
                    'any_previleges_university'	=> $data['any_previleges_university'],
                    'outside_university'		=> $data['outside_university'],
                    'name_scholarship_amount'	=> $data['name_scholarship_amount'],
                    'own_properties'			=> $data['own_properties'],
                    'property_name'				=> $data['property_name'],
                    'market_value'				=> $data['market_value'],
                    'property_others'			=> $data['property_others'],
                    'parents_separated'			=> $data['parents_separated'],
                    'married_separated'			=> $data['married_separated'],
                    'giving_amount'				=> $data['giving_amount'],
                    'personal_photo'			=> $data['personal_photo'],
                    'already_enrolled'			=> $data['already_enrolled'],
                    'form_five'					=> $data['form_five'],
                    'copy_of_grade'				=> $data['copy_of_grade'],
                    'certification_year_level'	=> $data['certification_year_level'],
                    'transcript_of_record'		=> $data['transcript_of_record'],
                    'good_moral'				=> $data['good_moral'],
                    'birth_certificate'			=> $data['birth_certificate'],
                    'letter_recommendation'		=> $data['letter_recommendation'],
                    'date_created'			    => date('Y-m-d H:i:s'),
                    'member_status'		        => 'For Approval',
                );

                $member_id = $this->scholar_request_model->insert_member_details($insert_member);
                if ($member_id != '') {
                    //Send email
                    // $mail_data = [
                    // 	'name_to' => $data['student_first_name'],
                    // ];

                    // $this->send_email_html([
                    // 	'mail_to'       => $data['email_address'],
                    // 	'cc'            => [],
                    // 	'subject'       => 'Scholarship Application [Approved]',
                    // 	'template_path' => 'email_template/application_approved',
                    // 	'mail_data'     => $mail_data,
                    // ]);
                    $this->system_counter->increment_ctrl_num($this->counter_member);
                    $this->scholar_request_model->update_scholarship_application($application_id);
                    //Generate Account Details
                    $password = $this->generateRandomString();
                    $member_account = array(
                        'user_type_id'      => STUDENT,
                        'username'          => $scholarship_no,
                        'password'          => password_hash($password, PASSWORD_DEFAULT),
                        'temp_password'     => $password,
                        'date_created'      => date('Y-m-d H:i:s'),
                    );
                    $user_id = $this->scholar_request_model->insert_user_acct($member_account);
                    if ($user_id != '') {
                        $this->scholar_request_model->update_member_details($user_id, $member_id);

                        // $mail_data = [
                        // 	'name_to' => $data['student_first_name'],
                        //  'username' => $scholarship_no,
                        //  'password' => $password,
                        //  'student_link' => '',
                        // ];

                        // $this->send_email_html([
                        // 	'mail_to'       => $data['email_address'],
                        // 	'cc'            => [],
                        // 	'subject'       => 'Account Credentials',
                        // 	'template_path' => 'email_template/account_credentials',
                        // 	'mail_data'     => $mail_data,
                        // ]);
                    }
                    $success = 'Application successfully approved.';
                } else {
                    $error = 'Failed to update the data.';
                }
            }
        } else {
            //Declined
            $decline_application = array(
                'application_status' => 'Declined',
            );

            $result = $this->scholar_request_model->decline_application($decline_application, $application_id);
            if ($result == TRUE) {
                //Send email
                // $mail_data = [
                // 	'name_to' => $data['student_first_name'],
                // ];

                // $this->send_email_html([
                // 	'mail_to'       => $data['email_address'],
                // 	'cc'            => [],
                // 	'subject'       => 'Scholarship Application [Declined]',
                // 	'template_path' => 'email_template/application_declined',
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

}