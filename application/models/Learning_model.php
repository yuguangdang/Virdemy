<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Learning_model extends CI_Model{

    public function save_item($item_data){
        $data = array(
            'user_id' => $item_data['user_id'],
            'course_id' => $item_data['course_id'],
        );
        $query = $this->db->insert('learning', $data);
        return $this->db->affected_rows() > 0;
    }

    
    public function get_items($user_id){
        $this->db->select("*");
        $this->db->from('learning');
        $this->db->where('user_id', $user_id);
        return $this->db->get()->result_array();
    }
}