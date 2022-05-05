<?php

class Auth_module {
    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function check_user_login() {
        if (!$this->CI->session->userdata('logged_in')) {
            redirect(site_url('login'));
        }
    }
}

?>