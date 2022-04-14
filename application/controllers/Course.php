<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller { 
    public function __construct() {
        parent:: __construct();
		$this->load->model('file_model');
		$this->load->model('course_model');
    }

    public function index()
	{
		$data['error']= "";
		$this->load->view('template/header');
		$this->load->view('home', $data);
        $this->load->view('template/footer');
	}

	public function render_create_course() {
		$this->load->view('template/header');
		$this->load->view('create_course');
        $this->load->view('template/footer');
	}

    public function create_course()
	{
		$courseTitle = $this->input->post('courseTitle');
        $description = $this->input->post('description');
		$creator_id = $this->session->userdata('user_id');

		$course_id = $this->course_model->create_course($creator_id, $courseTitle, $description);
        if ($course_id) {
			$data = array('error' => "", 'course_id' => $course_id);
			$this->load->view('template/header');
			$this->load->view('add_course_file', $data);
			$this->load->view('template/footer');
		} else {

		}
	}

	private function configure_upload() {
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|mp4|mkv';
		$config['max_size'] = 20000;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;
		$this->load->library('upload', $config);
	}

    public function upload_course_img()
	{
		$course_id = $this->input->post('course_id');
		$this->configure_upload();

		if (!$this->upload->do_upload('userfile')) {
			$this->load->view('template/header');
			$data = array('course_id' => $course_id);
			$this->session->set_flashdata('img_error', $this->upload->display_errors());
			$this->load->view('add_course_file', $data);
			$this->load->view('template/footer');
		} else {
			$file_id = $this->file_model->upload_image($this->upload->data('file_name'), $this->upload->data('full_path'), $course_id);
			$this->session->set_flashdata('img_message', 'Course picture successfully uploaded!');
			$data = array(
				'error' => "", 
				'course_id' => $course_id,
			);
			$this->load->view('template/header');
			$this->load->view('add_course_file', $data);
			$this->load->view('template/footer');
			return $file_id;
		}
	}

	public function upload_course_video()
	{
		$course_id = $this->input->post('course_id');
		$this->configure_upload();

		if (!$this->upload->do_upload('userfile')) {
			$this->load->view('template/header');
            $data = array('course_id' => $course_id);
			$this->session->set_flashdata('vid_error', $this->upload->display_errors());
			$this->load->view('add_course_file', $data);
			$this->load->view('template/footer');
		} else {
			$file_id = $this->file_model->upload_video($this->upload->data('file_name'), $this->upload->data('full_path'), $course_id);
			$this->session->set_flashdata('vid_message', 'Course video successfully uploaded!');
			$data = array(
				'error' => "", 
				'course_id' => $course_id,
			);
			$this->load->view('template/header');
			$this->load->view('add_course_file', $data);
			$this->load->view('template/footer');
			return $file_id;
		}
	}
}
