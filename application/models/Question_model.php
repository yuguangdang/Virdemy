<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Question_model extends CI_Model{


    public function save_question($question_data){

        $data = array(
            'question_title' => $question_data['question_title'],
            'question_content' => $question_data['question_content'],
            'creator_id' => $question_data['creator_id'],
            'creator_name' => $question_data['creator_name'],
            'course_id' => $question_data['course_id']
        );
        $query = $this->db->insert('question', $data);
        return $this->db->insert_id();    
    }

    
    public function get_questions($course_id){
        $this->db->select("*");
        $this->db->from('question');
        $this->db->where('course_id', $course_id);
        return $this->db->get();
    }
    
    public function fetch_question($query, $start) {
        if($query == '')
        {   
            $this->db->select("*");
            $this->db->from("question");
            $this->db->limit($start);
            return $this->db->get();
        }else{
            $this->db->select("*");
            $this->db->from("question");
            $this->db->like('question_title', $query);
            $this->db->or_like('question_content', $query);
            $this->db->order_by('create_time', 'DESC');
            return $this->db->get();
        }
    }
}