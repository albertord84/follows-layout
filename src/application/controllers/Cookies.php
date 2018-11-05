<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cookies extends CI_Controller {

    public function replace($client_id) {
        $this->load->model('class/user_role');
        $is_auth = $this->session->userdata('id') &&
            $this->session->userdata('role_id')==user_role::ADMIN;
        if ($this->input->method()==='post' && $is_auth) {
            $cookies = $this->input->post('cookies');
            $this->db->where('user_id', $client_id);
            $this->db->set('cookies', $cookies);
            $this->db->update('clients');
        }
    }

}

