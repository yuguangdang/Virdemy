<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Cart_model extends CI_Model{


    public function save_item($item_data){

        $data = array(
            'course_id' => $item_data['course_id'],
            'user_id' => $item_data['user_id'],
        );
        $query = $this->db->insert('cart', $data);
        return $this->db->affected_rows() > 0;
    }

    
    public function get_items($user_id){
        $this->db->select("*");
        $this->db->from('cart');
        $this->db->where('user_id', $user_id);
        return $this->db->get()->result_array();
    }
    
    public function remove_item($course_id) {
        $this->db->where('course_id', $course_id);
        $this->db->delete('cart');
    }
}