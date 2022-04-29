<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here 
 class File_model extends CI_Model{

    // upload file
    public function upload_image($filename, $path, $course_id){

        $data = array(
            'filename' => $filename,
            'path' => $path,
            'course_id' => $course_id,
        );
        $query = $this->db->insert('course_image', $data);
        return $this->db->insert_id();    
    }

    public function upload_video($filename, $path, $course_id){

        $data = array(
            'filename' => $filename,
            'path' => $path,
            'course_id' => $course_id,
        );
        $query = $this->db->insert('course_video', $data);
        return $this->db->insert_id();    
    }

    public function get_file($file_table, $course_id){
        $this->db->select("*");
        $this->db->from($file_table);
        $this->db->where('course_id', $course_id);
        return $this->db->get();
    }

    public function get_video_by_id($video_id){
        $this->db->select("*");
        $this->db->from('course_video');
        $this->db->where('video_id', $video_id);
        return $this->db->get()->row_array();
    }

    public function delete_video_by_id($video_id) {
        $this->db->delete('course_video', array('video_id' => $video_id));
    }
}