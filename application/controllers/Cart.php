<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller { 
    public function __construct() {
        parent:: __construct();
		$this->load->model('cart_model');
		$this->load->model('course_model');
		$this->load->model('file_model');
		$this->load->model('user_model');
		$this->load->model('learning_model');
    }

    public function index() {
        $user_id = $this->session->userdata['user_id'];
        $items = $this->cart_model->get_items($user_id);
        

        $cart_items = [];
        $total_price = 0;

        foreach ($items as $item) {
            $course_pic = $this->file_model->get_file($file_table = 'course_image', $item['course_id']);
            if (is_object($course_pic->row())) {
                $pic_name = $course_pic->row()->filename;
            } else {
                $pic_name = 'no-image.jpeg';
            }
            $course_data = $this->course_model->get_course_by_id($item['course_id']);
            $course_id = $course_data->course_id;
            $course_name = $course_data->course_name;
            $course_price = $course_data->price;
            $total_price += $course_price;
            $item = array(
                'course_id' => $course_id,
                'course_name' => $course_name, 
                'course_price' => $course_price, 
                'course_pic' => base_url(). "uploads/" . $pic_name,
            );
            array_push($cart_items, $item);
        }

        $data = array('items' => $cart_items, 'totalPrice' => $total_price, 'page' => 'cart' );

        $this->load->view('template/header', $data);
        $this->load->view('cart', $data);
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

            // Determine if the course has been bought.
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
                'addedToCart'=> true,
                'purchased' => in_array($course_id, $courses),
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

    // public function add_to_learning() {
    //     $user_id = $this->session->userdata['user_id'];
    //     $items = $this->cart_model->get_items($user_id);
    //     $learning_items = [];

    //     foreach ($items as $item) {
    //         $course_data = $this->course_model->get_course_by_id($item['course_id']);
    //         $course_id = $course_data->course_id;
    //         array_push($learning_items, $course_id);
    //     }

    //     foreach ($learning_items as $item) {
    //         $course_id = $item;
    //         $item_data = array('user_id' => $user_id, 'course_id' => $course_id );
    //         $this->learning_model->save_item($item_data);
    //     }

    //     redirect('learning');
        

    // }
}
