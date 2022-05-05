<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller { 
    public function __construct() {
        parent:: __construct();
		$this->load->model('file_model');
		$this->load->model('course_model');
		$this->load->model('user_model');
		$this->load->model('question_model');
		$this->load->model('learning_model');
    }

    public function index()
	{
		$data = array('page' => '');
		$this->load->view('template/header', $data);
		$this->load->view('home');
        $this->load->view('template/footer');
	}

	public function render_create_course() {
		$data = array('page' => 'create_course');
		$this->load->view('template/header', $data);
		$this->load->view('create_course');
        $this->load->view('template/footer');
	}

    public function create_course()
	{
		$courseTitle = $this->input->post('courseTitle');
        $description = $this->input->post('description');
        $coursePrice= $this->input->post('coursePrice');
		$creator_id = $this->session->userdata('user_id');

		$course_id = $this->course_model->create_course($creator_id, $courseTitle, $description, $coursePrice);
        if ($course_id) {
			$data = array('error' => "", 'course_id' => $course_id, 'page'=>'create_course');
			$this->load->view('template/header',$data);
			$this->load->view('add_course_file', $data);
			$this->load->view('template/footer');
		} else {

		}
	}

	private function configure_upload() {
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|mp4|mkv|jpeg|png';
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
			$data = array('course_id' => $course_id, 'page'=>'create_course');
			$this->load->view('template/header', $data);
			$this->session->set_flashdata('img_error', $this->upload->display_errors());
			$this->load->view('add_course_file', $data);
			$this->load->view('template/footer');
		} else {
			$file_id = $this->file_model->upload_image($this->upload->data('file_name'), $this->upload->data('full_path'), $course_id);
			$this->session->set_flashdata('img_message', 'Course picture successfully uploaded!');

			// Add watermark
			$config['source_image'] = $this->upload->data('full_path'); //The path of the image to be watermarked
			$config['wm_text'] = 'Virdemy 2022';
			$config['wm_type'] = 'text';
			$config['wm_font_path'] = './system/fonts/texb.ttf';
			$config['wm_font_size'] = '24';
			$config['wm_font_color'] = '#2e5e4e';
			$config['wm_vrt_alignment'] = 'center';
			$config['wm_hor_alignment'] = 'center';
			$config['wm_padding'] = '20';

			$this->image_lib->initialize($config);
			if (!$this->image_lib->watermark()) {
			echo $this->image_lib->display_errors();
			}

			$data = array(
				'error' => "", 
				'course_id' => $course_id,
				'page' => 'create_course'
			);
			$this->load->view('template/header', $data);
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
            $data = array('course_id' => $course_id, 'page'=>'create_course');
			$this->load->view('template/header', $data);
			$this->session->set_flashdata('vid_error', $this->upload->display_errors());
			$this->load->view('add_course_file', $data);
			$this->load->view('template/footer');
		} else {
			$file_id = $this->file_model->upload_video($this->upload->data('file_name'), $this->upload->data('full_path'), $course_id);
			$this->session->set_flashdata('vid_message', 'Course video successfully uploaded!');
			$data = array(
				'error' => "", 
				'course_id' => $course_id,
				'page' => 'create_course'
			);
			$this->load->view('template/header',$data);
			$this->load->view('add_course_file', $data);
			$this->load->view('template/footer');
			return $file_id;
		}
	}

	public function get_course_img($course_id)
	{
		$course_id = $this->uri->segment('3');
		$result = $this->course_model->get_course_by_id($course_id);
		print "<pre>";
        print_r($result);
        print "</pre>";
		
	}

	public function course_lookup()
	{
		$course_id = $this->uri->segment('3');
		$result = $this->course_model->get_course_by_id($course_id);

		$course_pic = $this->file_model->get_file($file_table = 'course_image', $course_id);
		if (is_object($course_pic->row())) {
			$pic_name = $course_pic->row()->filename;
		} else {
			$pic_name = 'no-image.jpeg';
		}

		// Get course creator name
		$user_data = $this->user_model->get_user_by_id($result->creator_id);
		$videos = $this->file_model->get_file('course_video', $course_id)->result_array();

        $user_id = $this->session->userdata['user_id'];
		$items = $this->learning_model->get_items($user_id);
		$courses = [];
		foreach($items as $item) {
			array_push($courses, $item['course_id']);
		}

		$data = array(
			'course_id' => $course_id,
			'course_pic' => base_url(). "uploads/" . $pic_name,
			'course_name' => $result->course_name,
			'description' => $result->course_description,
			'creator' => $user_data['name'],
			'price' => $result->price, 
			'videos' => $videos,
			'purchased' => in_array($course_id, $courses),
		);

		$this->load->view('template/header', $data);
		$this->load->view('course_lookup', $data);
		$this->load->view('template/footer');
	}

	public function view_course()
	{
		$course_id = $this->uri->segment('3');
		$video_id = $this->uri->segment('4');

		$video_name = $this->file_model->get_video_by_id($video_id)['filename'];
		$videos = $this->file_model->get_file('course_video', $course_id)->result_array();

		$questions = $this->question_model->get_questions($course_id)->result_array();
		$total_questions = count($questions);

		$data = array(
				'course_id' => $course_id,
				'videos' => $videos,
				'video' => $video_name,
				'questions' => $questions,
				'total_questions' => $total_questions,
	 		);

		$this->load->view('template/header');
		$this->load->view('view_course', $data);
		$this->load->view('template/footer');
	}

	public function course_edit() {
		$course_id = $this->uri->segment(3); 
		$course_data = $this->course_model->get_course_by_id($course_id);
		$videos = $this->file_model->get_file('course_video', $course_id)->result_array();

		$data = array(
			'course_id' => $course_id,
			'course_name' => $course_data->course_name,
			'course_description' => $course_data->course_description,
			'price' => $course_data->price, 
			'videos' => $videos,
			'page' => ''
		);
		
		$this->load->view('template/header', $data);
		$this->load->view('course_edit', $data);
		$this->load->view('template/footer');
	}

	public function update_course()
	{
		$courseTitle = $this->input->post('courseTitle');
        $description = $this->input->post('description');
        $coursePrice= $this->input->post('coursePrice');
		$creator_id = $this->session->userdata('user_id');
		$course_id = $this->input->post('course_id');

		$this->course_model->update_course($course_id, $creator_id, $courseTitle, $description, $coursePrice);
		$this->session->set_flashdata('message', 'Course information successfully updated!');
		redirect('course/course_edit/'.$course_id);
	}

	public function course_delete() {
		$course_id = $this->uri->segment('3');
		$this->course_model->delete_course($course_id);
		redirect('profile');
	}

	public function delete_video() {
		$course_id = $this->uri->segment('3');
		$video_id = $this->uri->segment('4');
		echo $video_id;
		$this->file_model->delete_video_by_id($video_id);
		redirect('course/course_edit/'.$course_id);
	}

	public function add_course_video()
	{
		$course_id = $this->input->post('course_id');
		$countfiles = count($_FILES['files']['name']);
		
		for($i=0; $i<$countfiles; $i++) {
			if(!empty($_FILES['files']['name'][$i])) {
				$_FILES['file']['name'] = $_FILES['files']['name'][$i];
				$_FILES['file']['type'] = $_FILES['files']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['files']['error'][$i];
				$_FILES['file']['size'] = $_FILES['files']['size'][$i];

				$config['upload_path'] = 'uploads/'; 
				$config['allowed_types'] = 'mp4|mkv';
				$config['max_size'] = '20000'; 
				$config['file_name'] = $_FILES['files']['name'][$i];

				$this->load->library('upload',$config); 

				if($this->upload->do_upload('file')){
					$this->file_model->upload_video($this->upload->data('file_name'), $this->upload->data('full_path'), $course_id);
				  } else {
					echo $this->upload->display_errors();
				  }
			}
		}
		redirect('course/course_edit/'.$course_id);
	}
}
