<?php



    class system_config extends CI_Model {
        
        public function load() {
            $vars = new stdClass();
            $this->db->select('*');
            $this->db->from('dumbudb.dumbu_system_config');
            $result = $this->db->get()->result_array();        
            if($result) {
                foreach ($result as $var_info) {
                    $vars->{$var_info["name"]} = $var_info["value"];
                }
            } else {
                die("Can't load system config vars...!!");
            }
            return $vars;
        }
    }
    