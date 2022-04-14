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

}