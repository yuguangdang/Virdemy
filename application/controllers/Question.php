<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller { 
    public function __construct() {
        parent:: __construct();
		$this->load->model('question_model');
		$this->load->model('user_model');
    }

    public function index()
	{
        $question_title = $this->input->post('question_title');
        $question_content = $this->input->post('question_content');
        $creator_id = $this->session->userdata('user_id');
        $creator = $this->user_model->get_user_by_id($creator_id);

        $course_id = $this->input->post('course_id');
        $video_id = $this->input->post('video_id');
        $question_data = array(
            'question_title' => $question_title, 
            'question_content' => $question_content, 
            'creator_id' => $creator_id,
            'creator_name' => $creator['name'],
            'course_id' => $course_id, 
        );

        $question_id = $this->question_model->save_question($question_data);
        redirect('course/view_course/' . $course_id . "/" . $video_id);
	}
}
