<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profile extends CI_Controller { 
    public function __construct() {
        parent:: __construct();
    }

    public function index()
	{
		$data['error']= "";
		
        $email = $this->session->userdata['email'];
        $data = $this->user_model->get_user_by_email($email);

        $this->load->view('template/header');
		$this->load->view('profile', $data);
        $this->load->view('template/footer');
	}
}

?>