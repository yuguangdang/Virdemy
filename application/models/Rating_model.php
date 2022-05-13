<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Rating_model extends CI_Model{


    public function insert_rating($rating_data){

        $data = array(
            'user_id' => $rating_data['user_id'],
            'course_id' => $rating_data['course_id'],
            'rating' => $rating_data['starcount'],
        );
        $query = $this->db->insert('rating', $data);
        return $this->db->insert_id();    
    }

    
    public function get_average_rating($course_id){
        $this->db->select('AVG(rating) as average');
        $this->db->where('course_id', $course_id);
        $this->db->from('rating');
        return $query = $this->db->get()->result_array();
    }

    public function get_rating_num($course_id){
        $this->db->select('COUNT(rating) as count');
        $this->db->where('course_id', $course_id);
        $this->db->from('rating');
        return $query = $this->db->get()->result_array();
    }
}