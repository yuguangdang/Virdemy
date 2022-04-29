<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Course_model extends CI_Model{

    public function create_course($creator_id, $course_name, $course_description, $coursePrice){

        $data = array(
            'creator_id' => $creator_id,
            'course_name' => $course_name,
            'course_description' => $course_description,
            'price' => $coursePrice,
        );
        $query = $this->db->insert('course', $data);
        return $this->db->insert_id();    
    }

    public function update_course($course_id, $creator_id, $course_name, $course_description, $coursePrice){

        $data = array(
            'course_id' => $course_id,
            'creator_id' => $creator_id,
            'course_name' => $course_name,
            'course_description' => $course_description,
            'price' => $coursePrice,
        );
        $query = $this->db->replace('course', $data);   
    }

    function fetch_data($query)
    {
        if($query == '')
        {
            return null;
        }else{
            $this->db->select("*");
            $this->db->from("course");
            $this->db->like('course_name', $query);
            $this->db->or_like('course_description', $query);
            $this->db->order_by('course_name', 'DESC');
            return $this->db->get();
        }
    }

    function get_courses($creator_id = '') {
        if ($creator_id == '') {
            $this->db->select('*');
            $this->db->from('course');
            return $this->db->get();
        } else {
            $this->db->select('*');
            $this->db->from('course');
            $this->db->where('creator_id', $creator_id);
            return $this->db->get();
        }
    }

    function get_course_by_id($course_id) {
        $this->db->select('*');
        $this->db->from('course');
        $this->db->where('course_id', $course_id);
        return $this->db->get()->row();
    }

    function delete_course($course_id) {
        $this->db->delete('course', array('course_id' => $course_id)); 
    }

}