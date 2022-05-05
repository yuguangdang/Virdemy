<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Learning extends CI_Controller { 
    public function __construct() {
        parent:: __construct();
		$this->load->model('course_model');
		$this->load->model('file_model');
		$this->load->model('user_model');
		$this->load->model('learning_model');
    }

    public function index() {

        $user_id = $this->session->userdata['user_id'];
        $items = $this->learning_model->get_items($user_id);

        $courses = [];
        foreach ($items as $row) {
            // Get course picture file path
            $course_id = $row['course_id'];
            $course_data = $this->course_model->get_course_by_id($course_id);
            $course_pic = $this->file_model->get_file($file_table = 'course_image', $course_id);
            if (is_object($course_pic->row())) {
                $pic_name = $course_pic->row()->filename;
            } else {
                $pic_name = 'no-image.jpeg';
            }
            // Get course creator name
            $course = array(
                'course_id' => $course_id,
                'course_pic' => base_url(). "uploads/" . $pic_name,
                'course_name' => $course_data->course_name, 
            );
            array_push($courses,$course);
        }

		$data = array(
            'page' => 'learning',
            'courses' => $courses,
        );
        
        $this->load->view('template/header', $data);
        $this->load->view('learning', $data);
        $this->load->view('template/footer');
    }

    public function add_in_cart() {
        $user_id = $this->session->userdata['user_id'];
        $course_id = $this->uri->segment('3');
        $item_data = array(
            'user_id' => $user_id, 
            'course_id' => $course_id,
        );
        if ($this->cart_model->save_item($item_data)) {

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

            $data = array(
                'course_id' => $course_id,
                'course_pic' => base_url(). "uploads/" . $pic_name,
                'course_name' => $result->course_name,
                'description' => $result->course_description,
                'creator' => $user_data['name'],
                'price' => $result->price, 
                'videos' => $videos,
                'addedToCart'=> true,
            );

            $this->load->view('template/header', $data);
            $this->load->view('course_lookup', $data);
            $this->load->view('template/footer');
        };
    }

    public function remove($course_id) {
        $this->cart_model->remove_item($course_id);
        redirect('cart');
    }

    public function add_to_learning() {
        $user_id = $this->session->userdata['user_id'];
        $items = $this->cart_model->get_items($user_id);
        $learning_items = [];

        foreach ($items as $item) {
            $course_data = $this->course_model->get_course_by_id($item['course_id']);
            $course_id = $course_data->course_id;
            array_push($learning_items, $course_id);
        }

        foreach ($learning_items as $item) {
            $course_id = $item;
            $item_data = array('user_id' => $user_id, 'course_id' => $course_id );
            $this->learning_model->save_item($item_data);
        }

        redirect('learning');
        

    }
}
