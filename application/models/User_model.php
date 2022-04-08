<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
    // Log in 
    public function login($email, $password) {
        // Validate
        $this->db->where('email', $email);
        $this->db->where('password', $password);

        $result = $this->db->get('user');

        if($result->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function email_check($email) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email);
        $query=$this->db->get();
        
        if($query->num_rows()>0){
            return false;
        }else{
            return true;
        }
    }

    public function register($user) {
        $this->db->insert('user', $user);      
    }
}
?>