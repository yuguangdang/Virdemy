<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller { 
    public function __construct() {
        parent:: __construct();
        $this->load->library('session'); //enable session
    }

    public function index()
	{
		$data['error']= "";
		$this->load->view('template/header');
		$this->load->view('home', $data);
	}
}

?>