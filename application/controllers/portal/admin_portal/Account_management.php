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

class Account_management extends MY_Controller
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
        $this->load->model('portal/admin_portal/account_management_model');

        $this->output->set_header("X-Robots-Tag: noindex");
        $this->output->set_header('Cache-Control: no-store, no-cache');
        
        //Check Session
        $this->check_session('adminIn', 'login');
    } //End __construct

    public function index()
    {
        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/portal');
        $data['active_page'] = 'account_page';
        $data['card_title'] = 'Account Management';
        $data['icon'] = 'bi bi-person-fill-gear';
        $data['header_contents'] = array(
            '<script>
                var csrf_token_name = "'.$this->security->get_csrf_token_name().'";
                var csrf_token_value = "'.$this->security->get_csrf_hash().'";
            </script>'
        );
        $this->load->view('admin_portal/partial/_header', $data);
        $this->load->view('admin_portal/account_management', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function account_list()
    {
        $user_type = $this->cipher->decrypt($this->input->get('info'));
        if ($user_type == ADMINISTRATOR) {
            $data['card_title'] = 'Administrator Account';
        } elseif ($user_type == ADMIN_STAFF) {
            $data['card_title'] = 'Admin Staff Account';
        } else {
            $data['card_title'] = 'Student Account';
        }

        $data['role_permissions'] = $this->role_permissions();
        $data['home_url'] = base_url('admin/portal');
        $data['active_page'] = 'account_page';
        $data['icon'] = 'bi bi-person-fill-gear';
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
        $this->load->view('admin_portal/account_table/account_list', $data);
        $this->load->view('admin_portal/partial/_footer', $data);
    }

    public function getUserTotal()
    {
        $admin = $this->account_management_model->getUserTotal(ADMINISTRATOR);
        $user = $this->account_management_model->getUserTotal(ADMIN_STAFF);
        $student = $this->account_management_model->getUserTotal(STUDENT);

        $output = array(
            'total_admin'   => $admin,
            'total_user'    => $user,
            'total_student' => $student,
        );
        echo json_encode($output);
    }


    public function get_account_list()
    {
        $account = $this->account_management_model->get_account_list();
        $data = array();
        $no = $_POST['start'];
        $user_type_id = $this->input->post('user_type');
        foreach ($account as $list) {
            $no++;
            $row = array();

            if ($user_type_id == ADMINISTRATOR || $user_type_id == ADMIN_STAFF) {
                $fullname = $list->last_name.', '.$list->first_name.' '.$list->middle_name;
                $email = $list->active_email;

                $fname = $list->first_name;
                $mname = $list->middle_name;
                $lname = $list->last_name;
            } else {
                $fullname = $list->student_last_name.', '.$list->student_first_name.' '.$list->student_middle_name;
                $email = $list->email_address;
            }

            $row[] = ucwords($fullname);
            $row[] = $list->username;
            $row[] = $email;

            if ($list->is_active == 1) {
                $row[] = '<label class="switch">
							  <input type="checkbox" class="account_activation" id="' . $list->user_id . '">
							  <span class="slider round"></span>
					  	  </label><br>Not Active';
            } else {
                $row[] = '<label class="switch">
							  <input type="checkbox" class="account_activation" id="' . $list->user_id . '" checked>
							  <span class="slider round"></span>
					  	  </label><br>Active';
            }

			$status = $list->is_active == 1 ? 
          '<label class="switch">
               <input type="checkbox" class="account_activation" id="' . $list->user_id . '">
               <span class="slider round"></span>
           </label><br>Not Active' : 
          '<label class="switch">
               <input type="checkbox" class="account_activation" id="' . $list->user_id . '" checked>
               <span class="slider round"></span>
           </label><br>Active';

			$view_button = '<i data-bs-toggle="modal" data-bs-target="#viewAccountManagementTableDetails"
            class="fa-solid fa-circle-plus view-account-management-btn"
                data-fullname="'.$fullname.'"
                data-username="'.$list->username.'"
            	data-email="'.$email.'"
              	data-status="'.htmlspecialchars($status, ENT_QUOTES, 'UTF-8').'"></i>';


            if ($user_type_id == ADMINISTRATOR) {
                $row[] = '
				<div class="d-block d-lg-none">' . $view_button . '</div> 
				<div class="btn-group d-none d-lg-block">
                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item link-cursor text-warning update_account"
                                    data-id="'.$list->user_id.'"
                                    data-fname="'.$fname.'"
                                    data-mname="'.$mname.'"
                                    data-lname="'.$lname.'"
                                    data-email="'.$email.'"
                                ><i class="bi bi-pencil-square me-2"></i>Update Account</a></li>
                                <li><a class="dropdown-item link-cursor text-danger" id="send_credentials" data-id="'.$list->user_id.'" data-user_type="'.$user_type_id.'"><i class="bi bi-send-fill me-1"></i>Resend Credentials</a></li>
                            </ul>
                        </div>';
            } elseif ($user_type_id == ADMIN_STAFF) {
                $row[] = '
				<div class="d-block d-lg-none">' . $view_button . '</div> 
				<div class="btn-group d-none d-lg-block">
                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item link-cursor text-primary add_permission" id="'.$list->user_id.'"><i class="bi bi-lock-fill me-2"></i>Add Permission</a></li>
                                <li><a class="dropdown-item link-cursor text-warning update_account"
                                    data-id="'.$list->user_id.'"
                                    data-fname="'.$fname.'"
                                    data-mname="'.$mname.'"
                                    data-lname="'.$lname.'"
                                    data-email="'.$email.'"
                                ><i class="bi bi-pencil-square me-2"></i>Update Account</a></li>
                                <li><a class="dropdown-item link-cursor text-danger" id="send_credentials" data-id="'.$list->user_id.'" data-user_type="'.$user_type_id.'"><i class="bi bi-send-fill me-1"></i>Resend Credentials</a></li>
                            </ul>
                        </div>';
            } else {
                $row[] = '
			<div class="d-block d-lg-none">' . $view_button . '</div> 
				<div class="btn-group d-none d-lg-block">
                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item link-cursor text-danger" id="send_credentials" data-id="'.$list->user_id.'" data-user_type="'.$user_type_id.'"><i class="bi bi-send-fill me-1"></i>Resend Credentials</a></li>
                            </ul>
                        </div>';
            }
            

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->account_management_model->count_all(),
            "recordsFiltered" => $this->account_management_model->count_filtered(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
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

    public function save_new_account()
    {
        $error = '';
        $success = '';

        $user_type = $this->input->post('user_type', true);
        switch ($user_type) {
            case ADMINISTRATOR:
                $remarks = 'Administrator ';
                break;
            
            case ADMIN_STAFF:
                $remarks = 'Admin Staff ';
                break;
        }

        $first_name = $this->input->post('first_name', true);
        $middle_name = $this->input->post('middle_name', true);
        $last_name = $this->input->post('last_name', true);
        $email_add = $this->input->post('email_add', true);

        $smallFname = strtolower($first_name);
        $smallLname = strtolower($last_name);

        $check_user = $this->account_management_model->check_existing_user($email_add, $user_type);
        if ($check_user->num_rows() > 0) {
            $error = $remarks.'account already exist.';
        } else {
            $password = $this->generateRandomString();
            $username = str_replace(' ','', $smallFname).str_replace(' ','', $smallLname).mt_rand(10000,99999);
            $insert_account = array(
                'user_type_id'      => $user_type,
                'username'          => $username,
                'password'          => password_hash($password, PASSWORD_DEFAULT),
                'temp_password'     => $password,
                'date_created'      => date('Y-m-d H:i:s'),
            );
            $user_id = $this->account_management_model->insert_user_acct($insert_account);
            if ($user_id != '') {
                $user_details = array(
                    'user_id'       => $user_id,
                    'first_name'    => $first_name,
                    'middle_name'   => $middle_name,
                    'last_name'     => $last_name,
                    'active_email'  => $email_add,
                    'date_created'  => date('Y-m-d H:i:s'),
                );
                $this->account_management_model->insert_user_details($user_details);
                // $mail_data = [
                // 	'name_to' => $first_name,
                //  'username' => $username,
                //  'password' => $password,
                //  'student_link' => '',
                // ];

                // $this->send_email_html([
                // 	'mail_to'       => $email_add,
                // 	'cc'            => [],
                // 	'subject'       => 'Account Credentials',
                // 	'template_path' => 'email_template/employee_account_credentials',
                // 	'mail_data'     => $mail_data,
                // ]);
            }
        }
        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }
    
    public function get_Permission()
    {
        $user_id = $this->input->post('user_id');
        $list = $this->account_management_model->get_permission_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $account) {
            $no++;
            $row = array();

            $query = $this->db->query("
                SELECT * FROM account_permissions WHERE perm_id = '" . $account->perm_id . "'
                AND user_id = '" . $user_id . "'
            ");

            $res = $query->row();
            if (isset($res->access) && $res->access == 'YES')
                $row[] = '<span>'.$account->perm_desc.'</span>';
            else
                $row[] = $account->perm_desc;

            if (isset($res->access) && $res->access == 'YES') {
                $row[] = '<label class="switch">
							  <input type="checkbox" class="apply_permission" id="' . $account->perm_id . '" data-user="' . $user_id . '" checked>
							  <span class="slider round"></span>
					  	  </label><br>ON';
            } else {
                $row[] = '<label class="switch">
						  <input type="checkbox" class="apply_permission" id="' . $account->perm_id . '" data-user="' . $user_id . '">
						  <span class="slider round"></span>
					  	 </label><br>OFF';
            } 
            $data[] = $row;  
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->account_management_model->count_all_permission(),
            "recordsFiltered" => $this->account_management_model->count_filtered_permission(),
            "data" => $data,
            "csrf_token_value" => $this->security->get_csrf_hash(),
            "csrf_token_name" => $this->security->get_csrf_token_name(),
        );
        echo json_encode($output);
    }

    public function apply_permission()
    {
        $message = '';
        $userID = $this->input->post('userID');
        $perm_id = $this->input->post('perm_id');
        $action = $this->input->post('action');

        if ($action == 'Grant') {
            $checkUser = $this->account_management_model->checkUser_permission($userID, $perm_id);
            if ($checkUser > 0) {
                $update_permission = array(
                    'access' => 'YES',
                );
                $update = $this->account_management_model->update_permission_granted($update_permission, $userID, $perm_id);
                if ($update == TRUE) {
                    $message = 'Success';
                } else {
                    $message = 'Error';
                }
            } else {
                $insert_permission = array(
                    'user_id' => $userID,
                    'perm_id' => $perm_id,
                    'access' => 'YES',
                    'date_created' => date('Y-m-d H:i:s'),
                );
                $result = $this->account_management_model->insert_permission_granted($insert_permission);
                if ($result == TRUE) {
                    $message = 'Success';
                } else {
                    $message = 'Error';
                }
            }
        } else {
            //Remove Permission
            $update_permission = array(
                'access' => 'NO',
            );
            $update = $this->account_management_model->update_permission_granted($update_permission, $userID, $perm_id);
            if ($update == TRUE) {
                $message = 'Success';
            } else {
                $message = 'Error';
            }
        }
        $output['message'] = $message;
        echo json_encode($output);
    }

    public function account_activation()
    {
        $message = '';
        $action = $this->input->post('action', true);
        $user_id = $this->input->post('user_id', true);

        if ($action == 'Activate') {
            $update_account = array(
                'is_active' => 0,//Active
            ); 
        } else {
            $update_account = array(
                'is_active' => 1,//Deactivate
            ); 
        }
        $result = $this->account_management_model->update_account($update_account, $user_id);
        if ($result == TRUE) {
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output['message'] = $message;
        echo json_encode($output);
    }

    public function update_account()
    {
        $error = '';
        $success = '';

        $user_id = $this->input->post('user_id', true);
        $first_name = $this->input->post('first_name', true);
        $middle_name = $this->input->post('middle_name', true);
        $last_name = $this->input->post('last_name', true);
        $email_add = $this->input->post('email_add', true);

        $update_account = array(
            'first_name'    => $first_name,
            'middle_name'   => $middle_name,
            'last_name'     => $last_name,
            'active_email'  => $email_add,
        );
        $result = $this->account_management_model->update_account_details($update_account, $user_id);
        if ($result == TRUE) {
            $success = 'Account information successfully updated.';
        } else {
            $error = 'Failed to update the data.';
        }
        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }
    
    public function resend_credentials()
    {
        $error = '';
        $success = '';
        $user_id = $this->input->post('user_id', true);
        $user_type = $this->input->post('user_type', true);
        $password = $this->generateRandomString();

        if ($user_type == ADMINISTRATOR || $user_type == ADMIN_STAFF) {
            $user_details = $this->account_management_model->get_row('admin_user_details', array('user_id' => $user_id));
            $template_path = 'email_template/employee_account_credentials';
            $first_name = $user_details['first_name'];
            $url_link = base_url('login');
            $email_add = $user_details['active_email'];
        } else {
            $user_details = $this->account_management_model->get_row('scholarship_member', array('user_id' => $user_id));
            $template_path = 'email_template/account_credentials';
            $first_name = $user_details['student_first_name'];
            $url_link = base_url('login');
            $email_add = $user_details['email_address'];
        }

        $user_acct = $this->account_management_model->get_row('user_acct', array('user_id' => $user_id));
        

        $update_account = array(
            'password'          => password_hash($password, PASSWORD_DEFAULT),
            'temp_password'     => $password,
        );

        $result = $this->account_management_model->update_account($update_account, $user_id);
        if ($user_id == TRUE) {

            // $mail_data = [
            // 	'name_to' => $first_name,
            //  'username' => $user_acct['username'],
            //  'password' => $password,
            //  'url_link' => $url_link,
            // ];

            // $this->send_email_html([
            // 	'mail_to'       => $email_add,
            // 	'cc'            => [],
            // 	'subject'       => 'Account Credentials',
            // 	'template_path' => $template_path,
            // 	'mail_data'     => $mail_data,
            // ]);

            $success = 'Success';
        } else {
            $error = 'Failed to resend the credentials.';
        }
        $output = array(
            'error' => $error,
            'success' => $success,
        );
        echo json_encode($output);
    }
}
