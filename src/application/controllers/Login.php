<?php
defined('BASEPATH') OR exit('No direct script access allowed');

<<<<<<< HEAD


=======
>>>>>>> develop
class Login extends CI_Controller {

    private function param(string $param_name) {
        $input = json_decode(file_get_contents('php://input'), true);
        return $input[$param_name];
    }

    public function browser() {
        $user = $this->param('user');
        $pass = $this->param('pass');
        $url = "https://191.252.111.93/src/index.php/login/browser/$user/$pass";
        return file_get_contents(
            $url, false,
            stream_context_create([
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ],
            ])
        );
    }

}
