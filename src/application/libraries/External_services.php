<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class External_services{
        
    function vindi_notif_post($post_str){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];        
        $postData = array(
            'post_str'=>urlencode($post_str)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/payment/vindi_notif_post";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return $response; 
    }
    
    //FUNÇÕES PARA INTERAGIR COM O INSTAGRAM ----------------------------------------------------------------
    function bot_login($client_login, $client_pass,$force_login){
        //bot_login com curl
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];        
        $postData = array(
            'login'=>urlencode($client_login),
            'pass'=>urlencode($client_pass),
            'force_login'=>urlencode($force_login)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/worker/bot_login";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);  
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        $response = json_decode($response);
        return $response;
    }
        
    function get_insta_ref_prof_data_from_client($cookies,$profile_name, $dumbu_id_profile=NULL, $user_id){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];        
        $postData = array(
            'cookies'=>urlencode(json_encode($cookies)),
            'profile_name'=>urlencode($profile_name),
            'dumbu_id_profile'=>urlencode($dumbu_id_profile),
            'user_id'=>urlencode($user_id)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/worker/get_insta_ref_prof_data_from_client";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);  
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }
    
    function get_insta_ref_prof_data($profile_name){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];        
        $postData = array(
            'profile_name'=>urlencode($profile_name)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/worker/get_insta_ref_prof_data";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);  
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }
    
    function get_insta_geolocalization_data_from_client($cookies,$profile_name, $dumbu_id_profile=NULL, $user_id){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];        
        $postData = array(
            'cookies'=>urlencode(json_encode($cookies)),
            'profile_name'=>urlencode($profile_name),
            'dumbu_id_profile'=>urlencode($dumbu_id_profile),
            'user_id'=>urlencode($user_id)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/worker/get_insta_geolocalization_data_from_client";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);  
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }
    
    function get_insta_tag_data_from_client($cookies,$profile_name, $dumbu_id_profile=NULL, $user_id){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];        
        $postData = array(
            'cookies'=>urlencode(json_encode($cookies)),
            'profile_name'=>urlencode($profile_name),
            'dumbu_id_profile'=>urlencode($dumbu_id_profile),
            'user_id'=>urlencode($user_id)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/worker/get_insta_tag_data_from_client";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);  
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }
    
    function checkpoint_requested($client_login, $client_pass){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];        
        $postData = array(
            'client_login'=>urlencode($client_login),
            'client_pass'=>urlencode($client_pass)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/worker/checkpoint_requested";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }
        
    function make_checkpoint($user_login, $security_code){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];
        $postData = array(
            'user_login'=>urlencode($user_login),
            'security_code'=>urlencode($security_code)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/worker/make_checkpoint";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }    
    
    function set_client_cookies_by_curl($client_id, $curl, $robot_id){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];
        $postData = array(
            'client_id'=>urlencode($client_id),
            'curl'=>urlencode($curl),
            'robot_id'=>urlencode($robot_id)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/worker/set_client_cookies_by_curl";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }
    
    function get_number_followed_today($client_id){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];
        $postData = array(
            'client_id'=>urlencode($client_id)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/worker/get_number_followed_today";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }    
    
    
    //------EMAILS DESDE O FOLLOWS-LAYOUT - GMAIL------------------------------------------------------
    function send_user_to_purchase_step($useremail, $username, $instaname, $purchase_access_token){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];
        $postData = array(
            'useremail'=>urlencode($useremail),
            'username'=>urlencode($username),
            'instaname'=>urlencode($instaname),
            'purchase_access_token'=>urlencode($purchase_access_token)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/gmail/send_user_to_purchase_step";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return (array)json_decode($response); 
    }
    
    function send_link_ticket_bank_and_access_link($username, $useremail, $access_link, $ticket_link){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];
        $postData = array(
            'username'=>urlencode($username),
            'useremail'=>urlencode($useremail),
            'access_link'=>urlencode($access_link),
            'ticket_link'=>urlencode($ticket_link)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/gmail/send_link_ticket_bank_and_access_link";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }
    
    function send_link_ticket_bank_in_update($username, $useremail, $ticket_url){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];
        $postData = array(
            'username'=>urlencode($username),
            'useremail'=>urlencode($useremail),
            'ticket_link'=>urlencode($ticket_link)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/gmail/send_link_ticket_bank_in_update";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }
    
    function send_client_contact_form($username, $useremail, $usermsg, $usercompany, $userphone){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];
        $postData = array(
            'username'=>urlencode($username),
            'useremail'=>urlencode($useremail),
            'usermsg'=>urlencode($usermsg),
            'usercompany'=>urlencode($usercompany),
            'userphone'=>urlencode($userphone)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/gmail/send_client_contact_form";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }
        
    function send_new_client_payment_done($username, $useremail, $plane = 0){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];
        $postData = array(
            'username'=>urlencode($username),
            'useremail'=>urlencode($useremail),
            'plane'=>urlencode($plane)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/gmail/send_new_client_payment_done";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }
    
    function send_client_payment_success($useremail, $username, $instaname, $instapass){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];
        $postData = array(
            'useremail'=>urlencode($useremail),
            'username'=>urlencode($username),
            'instaname'=>urlencode($instaname),
            'instapass'=>urlencode($instapass)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/gmail/send_client_payment_success";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }
    
    
    
    //------PAGAMENTO - VINDI------------------------------------------------------
    function addClient($credit_card_name, $user_email){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];
        $postData = array(
            'credit_card_name'=>urlencode($credit_card_name),
            'user_email'=>urlencode($user_email),
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/payment/vindi_addClient";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }
    
    function addClientPayment($user_id, $datas){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];
        $postData = array(
            'user_id'=>urlencode($user_id),
            'datas'=>urlencode(json_encode($datas)),
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/payment/vindi_addClientPayment";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }
    
    function create_recurrency_payment($user_id, $pay_day, $plane_type){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];
        $postData = array(
            'user_id'=>urlencode($user_id),
            'pay_day'=>urlencode(json_encode($pay_day)),
            'plane_type'=>urlencode(json_encode($plane_type))
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/payment/vindi_create_recurrency_payment";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }
    
    function create_payment($user_id, $prod_1real_id, $amount){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];
        $postData = array(
            'user_id'=>urlencode($user_id),
            'prod_1real_id'=>urlencode($prod_1real_id),
            'amount'=>urlencode($amount)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/payment/vindi_create_payment";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }
    
    function cancel_recurrency_payment($client_payment_key){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];
        $postData = array(
            'client_payment_key'=>urlencode($client_payment_key)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/payment/vindi_cancel_recurrency_payment";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }
    
    
    //------PAGAMENTO - MUNDI------------------------------------------------------
    function delete_payment($order_key){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];
        $postData = array(
            'order_key'=>urlencode($order_key)
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/payment/mundi_delete_payment";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return json_decode($response); 
    }
    
    function create_boleto_payment($payment_data){
        $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../FOLLOWS.INI", true);
        $worker_server_name = $database_config['server']['worker_server_name'];
        $postData = array(
            'payment_data'=>urlencode(json_encode($payment_data))
        );
        $url = "http://$worker_server_name/follows-worker/src/index.php/payment/mundi_create_boleto_payment";
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);  
        $response = curl_exec($handler);
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        return (array)json_decode($response); 
    }
    
    
    
    
}

?> 