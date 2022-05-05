<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ajax extends CI_Controller {
    public function fetch()
    {
		$this->load->model('question_model'); 
        $output = '';
        $query = '';
        $start = $this->input->get('start');

        if($this->input->get('query')){ 
            $query = $this->input->get('query'); 
        }
        $data = $this->question_model->fetch_question($query, $start); 
            if(!$data == null){
                echo json_encode ($data->result()); 
            }else{
                echo  ""; 
            }
    }
}
?>