<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller { 
    public function __construct() {
        parent:: __construct();
		$this->load->model('course_model');
		$this->load->model('file_model');
    }

    public function index()
	{
        $query = $this->course_model->get_courses();
        $courses = [];
        foreach ($query->result() as $row) {
            $course_id = $row->course_id;
            $course_pic = $this->file_model->get_file($file_table = 'course_image', $course_id);
            $pic_string = $course_pic->row()->path;
            $pic_path = explode("/",$pic_string);
            $course = array(
                'course_pic' => base_url(). "uploads/" .end($pic_path),
                'course_name' => $row->course_name, 
                'description' => $row->course_description, 
            );
            array_push($courses,$course);
            }
            
		$data = array('courses' => $courses, );
		$this->load->view('template/header');
		$this->load->view('home', $data);
        $this->load->view('template/footer');
	}
}
