<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Course_model extends CI_Model{

    public function create_course($creator_id, $course_name, $course_description){

        $data = array(
            'creator_id' => $creator_id,
            'course_name' => $course_name,
            'course_description' => $course_description,
        );
        $query = $this->db->insert('course', $data);
        return $this->db->insert_id();    
    }

    function fetch_data($query)
    {
        if($query == '')
        {
            return null;
        }else{
            $this->db->select("*");
            $this->db->from("files");
            $this->db->like('filename', $query);
            $this->db->or_like('username', $query);
            $this->db->order_by('filename', 'DESC');
            return $this->db->get();
        }
    }

    function get_courses() {
        $this->db->select('*');
        $this->db->from('course');
        return $this->db->get();
    }

}