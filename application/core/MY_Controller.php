<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
*
* @version 1.0
* @author Carlo Cano <carlocano03gmail.com>
* @copyright Copyright &copy; 2022,
*
*/

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        date_default_timezone_set( TIMEZONE );
        $this->lang->load('system_lang');
    }

    // Unset session data

    public function unset_session() {
        $this->session->sess_destroy();
    }

    public function check_session($sessionKey, $redirectUrl) {
        if (!$this->session->userdata($sessionKey)) {
            redirect($redirectUrl);
        }
    }

    // Removes array keys
    function remove_array_keys( $array ) {
        foreach ( $array as $k => $v ) {
            if ( is_array( $v ) ) {
                $array[ $k ] = $this->remove_array_keys( $v );
            }
            //if
        }
        //foreach
        return $this->sort_numeric_keys( $array );
    }

    // re-index the array starting from zero

    function sort_numeric_keys( $array ) {
        $i = 0;
        foreach ( $array as $k => $v ) {
            if ( is_int( $k ) ) {
                $rtn[ $i ] = $v;
                $i++;
            } else {
                $rtn[ $k ] = $v;
            }
            //if
        }
        //foreach
        return $rtn;
    }

    protected function append_csrf_token_info_into( &$response ) {
        $response[ 'token_name' ] = $this->security->get_csrf_token_name();
        $response[ 'token_value' ] = $this->security->get_csrf_hash();
    }

    protected function response_json( $response, $code = 200 ) {
        $this->output
        ->set_status_header( $code )
        ->set_content_type( 'application/json', 'utf-8' )
        ->set_output( json_encode( $response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) )
        ->_display();
        exit;
    }

    function role_permissions()
    {
        $this->load->model('admin_crm/role_permission_model');
        $user_id = $this->session->userdata('adminIn')['user_id'];

        $user_permissions = $this->role_permission_model->getUserPermissions($user_id);
        return $user_permissions;
    }

    function send_email_html($data) 
    {
        $this->config->load('email');
		$this->load->library('email');
		$config = [
			'mailtype' => 'html',
			'wordwrap' => TRUE,
		];
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
		$this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        $this->email->from($this->config->item('MAIL_FROM_ADDRESS'), $data['email_name']);
		$this->email->to($data['mail_to']);

        if (is_array($data['cc'])) {
			foreach ($data['cc'] as $email_cc) {
				$this->email->cc($email_cc);
			}
		}
        
        $subject = $data['subject'];
		$template = $data['template_path'];
		$mail_data = $data['mail_data'];

        $this->email->subject($subject);
		$this->email->message($this->load->view($template, $mail_data, TRUE));
        if($this->email->send()) {
			return TRUE;
		} else {
			log_message('error', $this->email->print_debugger());
			return FALSE;
		}
    }

}