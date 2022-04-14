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
            return true;
        }else{
            return false;
        }
    }

    public function register($user) {
        $this->db->insert('user', $user); 
        return $this->db->insert_id();    
    }

    public function get_user_by_email($email) {
        $query = $this->db->get_where('user',array('email'=>$email));
		return $query->row_array();
    }

    public function get_user_by_id($id) {
        $query = $this->db->get_where('user',array('user_id'=>$id));
		return $query->row_array();
    }

    public function get_user_by_token($token) {
        $query = $this->db->get_where('user',array('reset_token'=>$token));
		return $query->row_array();
    }

    public function update_user_data($data, $id){
		$this->db->where('user.user_id', $id);
		return $this->db->update('user', $data);
	}
}
?>