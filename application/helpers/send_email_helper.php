<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('send_email'))
{
    function send_email($emailTo, $name, $subject, $message) {
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'mailhub.eait.uq.edu.au',
			'smtp_port' => 25,
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE,
			'ailtype' => 'html',
			'starttls' => true,
			'newline' => "\r\n"
		);

		$ci = & get_instance();
		$ci->load->library('email');
		$ci->email->initialize($config);
		$ci->email->from ('yuguang.dang@uq.net.au', 'Yuguang Dang');
		$ci->email->to ($emailTo, $name);
		$ci->email->subject ($subject);
		$ci->email->message($message);
		$ci->email->attach(base_url() . 'uploads/cards.png');
		$ci->email->send();		
	} 
}