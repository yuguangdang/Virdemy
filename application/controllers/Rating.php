<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rating extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('send_email_helper');
        $this->load->helper('string');
        $this->load->model('rating_model');
    }

    public function index()
    {
    }

    public function insert_rating($course_id, $starcount)
    {   
        $user_id = $this->session->userdata('user_id');
        $rating_data = array(
            'user_id' => $user_id,
            'course_id' => $course_id,
            'starcount' => $starcount,
        );

        $this->rating_model->insert_rating($rating_data);
        redirect('learning');
    }
    
}
