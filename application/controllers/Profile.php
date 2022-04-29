<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profile extends CI_Controller { 
    public function __construct() {
        parent:: __construct();
        $this->email = $this->session->userdata['email'];
        $this->user_data = $this->user_model->get_user_by_email($this->email);
        $this->load->model('course_model');
        $this->load->model('file_model');
    }

    public function index()
	{	
        $user_id = $this->user_data['user_id'];
        $query = $this->course_model->get_courses($user_id);

        $courses = [];
        foreach ($query->result() as $row) {
            // Get course picture file path
            $course_id = $row->course_id;
            $course_pic = $this->file_model->get_file($file_table = 'course_image', $course_id);
            $pic_string = $course_pic->row()->path;
            $pic_path = explode("/",$pic_string);
            // Get course creator name
            $course = array(
                'course_id' => $course_id,
                'course_pic' => base_url(). "uploads/" .end($pic_path),
                'course_name' => $row->course_name, 
            );
            array_push($courses,$course);
        }

            // print "<pre>";
            // print_r($courses);
            // print "</pre>";
		$data = array(
            'page' => 'user',
            'courses' => $courses,
            'user_data' => $this->user_data,
        );
        $this->load->view('template/header', $data);
		$this->load->view('profile', $data);
        $this->load->view('template/footer');
	}

    public function change_username() {
        $user_name = $this->input->post('user_name');
        $user_id = $this->session->userdata['user_id'];
        $this->user_model->update_username($user_name, $user_id);
        $this->session->set_flashdata('username-message', 'Username updated successfully');
        redirect("profile");
    }
}

?>