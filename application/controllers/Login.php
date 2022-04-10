<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

    public function __construct() {
        parent:: __construct();
		$this->load->helper('send_email_helper');
		$this->load->helper('string');
    }

	public function index()
	{
		$data = array(
			'error' => "", 
			'success' => "",
			'state' => "login",
			'highlightItem' => "",
			'name' => "",
			'email' => "",
			'password' => "",
			'confirmPassword' => "",
		);
		$this->load->view('template/header');
		if (!$this->session->userdata('logged_in'))//check if user already login
		{
			$this->load->view('login', $data); //if user has not login ask user to login
		}else{
			$this->load->view('home'); //if user already logined show main page
		}
		$this->load->view('template/footer');
	}

	public function check_login()
	{
		
		$this->load->view('template/header');
		$email = $this->input->post('email'); 
		$password = md5($this->input->post('password')); 
		$remember = $this->input->post('remember'); //getting remember checkbox from login form

		$data = array(
			'error' => "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect email or passwrod! </div> ", 
			'success' => "",
			'state' => "login",
			'highlightItem' => "",
			'name' => "",
			'email' => $email,
			'password' => $password,
			'confirmPassword' => "",
		);

		if(!$this->session->userdata('logged_in')){	//Check if user already login
			if ( $this->user_model->login($email, $password) )//check username and password
			{
				$user_data = array(
					'email' => $email,
					'logged_in' => true 	//create session variable
				);
				if($remember) { // if remember me is activated create cookie
					set_cookie("email", $email, '300'); //set cookie username
					set_cookie("password", $password, '300'); //set cookie password
					set_cookie("remember", $remember, '300'); //set cookie remember
				}
				$this->session->set_userdata($user_data); //set user status to login in session
				redirect('home'); // direct user home page
			} else {
				$this->load->view('login', $data);	//if username password incorrect, show error msg and ask user to login
			}
		} else {
			{
				redirect('home'); //if user already logined direct user to home page
			}
		$this->load->view('template/footer');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in'); //delete login status
		session_destroy();
		redirect('home'); // redirect user back to login
	}


	public function register() {

		$this->load->view('template/header');

		// Data sanitation
		$error_message = "";
		$name = str_replace(' ', '', strip_tags($this->input->post('name')));
		$email = str_replace(' ', '', strip_tags($this->input->post('email')));
		$password = str_replace(' ', '', strip_tags($this->input->post('password')));
		$confirmPassword = str_replace(' ', '', strip_tags($this->input->post('confirmPassword')));
		$email_check = $this->user_model->email_check($email);

		// Input validation
		if (strlen($name) > 15 || strlen($name) < 2) {
			$error_message = "<div class=\"alert alert-danger\" role=\"alert\"> Name has to be between 2 and 25 letters long. </div>";
			$highlight_itme = "name";
		} else if ($email_check) {
			$error_message = "<div class=\"alert alert-danger\" role=\"alert\"> This email has been registered. </div>";
			$highlight_itme = "email";
		} else if (strlen($password) < 5) {
			$error_message = "<div class=\"alert alert-danger\" role=\"alert\"> Password has to be at least 5 characters. </div>";
			$highlight_itme = "password";
		} else if ($password != $confirmPassword) {
			$error_message = "<div class=\"alert alert-danger\" role=\"alert\"> Password and confirm password does not match. </div>";
			$highlight_itme = "password";
		} else if (preg_match('/[^A-Za-z0-9]/', $password)) {
			$error_message = "<div class=\"alert alert-danger\" role=\"alert\"> Your password can only contain english characters or numbers. </div>";
			$highlight_itme = "password";
		} 

		// Render login page when it fails and home page when register successfully. 
		if ($error_message != "") {
			$data = array(
				'success' => "", 
				'error' => $error_message,
				'state' => 'register',
				'highlightItem' => $highlight_itme,
				'name' => $name,
				'email' => $email,
				'password' => $password,
				'confirmPassword' => $confirmPassword
			);
			$this->load->view('login', $data);
		} else {
			// Register user
			$verify_code = random_string('alnum', 12);
			$user = array(
				'name' => str_replace(' ', '', $name), 
				'email' => str_replace(' ', '',$email), 
				'password' => md5($password), 
				'verify_code' => $verify_code,
				'active' => false
			);
			
			// Render login
			$user_id = $this->user_model->register($user);
			$sucess_message = "<div class=\"alert alert-success\" role=\"alert\"> Registered successfully. Now please login! </div> ";
			$data = array(
				'success' => $sucess_message, 
				'error' => "",
				'state' => 'login',
				'highlightItem' => "",
				'name' => "",
				'email' => "",
				'password' => "",
				'confirmPassword' => "",
			);
			$this->load->view('login', $data);

			// Sending verification email
			$subject = "Virdemy - Email address verification";
			$message = '<html><body>' . '<p">Hi, ' . $name .'</p>';
			$verify_link = base_url() . 'login/verify_email/' . $user_id . '/' . $verify_code;
			$message .= '<p>Please verify your email address <a href=' . $verify_link. '>here</a>.</p>';
			$message .= '</body></html>';
			send_email($email, $name, $subject, $message);
		}
	}

	public function verify_email() {
		$id =  $this->uri->segment(3);
        $code = $this->uri->segment(4);
		$user_data = $this->user_model->get_user_by_id($id);

		if($user_data['verify_code'] == $code){
            //update user active status
            $user_data['active'] = true;
            $query = $this->user_model->activate($user_data, $id);
 
            if($query){
                $this->session->set_flashdata('message', 'User account verified successfully');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong when verifying account');
            }
        }
        else{
            $this->session->set_flashdata('error', "Cannot verify account as code didn't match");
        }
		redirect(base_url(). 'profile');
	}

	public function render_reset_password() {
		$this->load->view('template/header');
		$this->load->view('reset_password');
		$this->load->view('template/footer');

	}

	public function send_reset_email() {
		$email = $this->input->post('email');
		$email_check = $this->user_model->email_check($email);

		if ($email_check) {
			$token = random_string('alnum', 8);

			$user_data = $this->user_model->get_user_by_email($email);
			$subject = "Virdemy - Email address verification";
			$name = $user_data['name'];
			$message = '<html><body>' . '<p">Hi, ' . $name .'</p>';
			$reset_link = base_url() . "login/send_reset_email/" . $token;
			$message .= '<p>Click this <a href=' .$reset_link . '>link</a> to set a new password.</P>';
			$message .= '</body></html>';
			send_email($email, $name, $subject, $message);
		} else {
			echo $email;
		}

		$this->load->view('template/header');
		$this->load->view('reset_password');
		$this->load->view('template/footer');
	}
}

?>