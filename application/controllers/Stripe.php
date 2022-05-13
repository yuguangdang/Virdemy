<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stripe extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->helper('url');
        $this->load->model('course_model');
        $this->load->model('cart_model');
        $this->load->model('learning_model');
        $this->load->helper('send_email_helper');
    }

    public function stripe_payment($totalPrice)
    {
        $data = array('totalPrice' => $totalPrice,);
        $this->load->view('my_stripe', $data);
    }

    public function stripePost()
    {
        require_once('application/libraries/stripe-php/init.php');

        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

        \Stripe\Charge::create([
            "amount" => 100 * 100,
            "currency" => "gbp",
            "source" => $this->input->post('stripeToken'),
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        $this->session->set_flashdata('success', 'Payment made successfully.');

        //Sending receipt via email

        $user_id = $this->session->userdata['user_id'];
        $items = $this->cart_model->get_items($user_id);
        $learning_items = [];
        $receipt_items = [];
        $total_price = 0;

        foreach ($items as $item) {
            $course_data = $this->course_model->get_course_by_id($item['course_id']);
            $total_price += $course_data->price;
            $course_id = $course_data->course_id;
            array_push($learning_items, $course_id);
            array_push($receipt_items, $course_data);
        }
        
        $receipt_data = array('receipt_items' => $receipt_items, 'total_price' => $total_price);
        $this->load->library('pdf');
        $html = $this->load->view('GeneratePdfView', $receipt_data, true);
        $this->pdf->createPDF($html);


        // Add purchased courses to learning.

        foreach ($learning_items as $item) {
            $course_id = $item;
            $item_data = array('user_id' => $user_id, 'course_id' => $course_id);
            $this->learning_model->save_item($item_data);
        }

        // Empty cart
        foreach ($learning_items as $item) {
            $this->cart_model->remove_item($item);
        }

        // redirect('learning');
    }
}
