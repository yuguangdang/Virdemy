<?php
defined('BASEPATH') OR exit('No direct script access allowed');
   
class Stripe extends CI_Controller {
    
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->library("session");
       $this->load->helper('url');
	    $this->load->model('course_model');
		$this->load->model('cart_model');
		$this->load->model('learning_model');
    }

    public function stripe_payment($totalPrice)
    {
        $data = array('totalPrice' => $totalPrice, );
        $this->load->view('my_stripe', $data);   
    }

    public function stripePost()
    {
        require_once('application/libraries/stripe-php/init.php');
    
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
     
        \Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "gbp",
                "source" => $this->input->post('stripeToken'),
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
            
        $this->session->set_flashdata('success', 'Payment made successfully.');

        // Add purchased courses to learning.
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

        // Empty cart
        foreach ($learning_items as $item) {
            $this->cart_model->remove_item($item);
        }
        redirect('learning');
    }
}