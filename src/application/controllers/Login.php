<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function browser() {
        $user = $this->input->post('user');
        $pass = $this->input->post('pass');
        $pass = $this->input->post('proxy');
        $data = array("user" => $user, "pass" => $pass, "proxy" => $proxy);
        $data_string = json_encode($data);
        $ch = curl_init('http://191.252.111.93/follows-worker/worker/test/browserLogin.php');
        //$ch = curl_init('http://191.252.111.93/browserLogin.php');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        $result = curl_exec($ch);
        echo $result;
    }

}
