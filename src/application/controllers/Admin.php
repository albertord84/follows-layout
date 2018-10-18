<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    
    //---- Functions to ADMIN-----------------------------
    public function index(){        
        $this->load->view('admin_login_view');
    }
      
    public function admin_do_login() {
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $datas['SERVER_NAME'] = $GLOBALS['sistem_config']->SERVER_NAME;        
        $datas = $this->input->post();        
        $this->load->model('class/user_model');
        $this->load->model('class/user_status');
        $this->load->model('class/user_role');
        $query = 'SELECT * FROM users'.
                ' WHERE login="' . $datas['user_login'] . '" AND pass="' . md5($datas['user_pass']) .
                '" AND role_id=' . user_role::ADMIN . ' AND status_id=' . user_status::ACTIVE;
        $user = $this->user_model->execute_sql_query($query);
        if(count($user)){
            $this->user_model->set_sesion($user[0]['id'], $this->session, '');
            $result['role'] = 'ADMIN';
            $result['authenticated'] = true;
            echo json_encode($result);
        } else{
            $result['resource'] = 'index#lnk_sign_in_now';
            $result['message'] = 'Credenciais incorretas';
            $result['cause'] = 'signin_required';
            $result['authenticated'] = false;
            echo json_encode($result);
        }
    }
    
    public function log_out() {
        $data['user_active'] = false;
        $this->load->model('class/user_model');
        $this->user_model->insert_washdog($this->session->userdata('id'),'CLOSING SESSION');
        $this->session->sess_destroy();
        header('Location: ' . base_url() . 'index.php/admin/');
    }    
    
    public function view_admin(){
        $this->load->model('class/user_model');
        $this->load->model('class/user_role');
        if ($this->session->userdata('id') && $this->session->userdata('role_id')==user_role::ADMIN) {
            $this->load->model('class/system_config');
            $GLOBALS['sistem_config'] = $this->system_config->load();
            $datas['SERVER_NAME'] = $GLOBALS['sistem_config']->SERVER_NAME;
            $query = 'SELECT DISTINCT utm_source FROM clients';
            $datas['utm_source_list'] = $this->user_model->execute_sql_query($query);
            $data['SCRIPT_VERSION'] = $GLOBALS['sistem_config']->SCRIPT_VERSION;
            $data['section1'] = $this->load->view('responsive_views/admin/admin_header_painel', '', true);
            $data['section2'] = $this->load->view('responsive_views/admin/admin_body_painel', $datas, true);
            $data['section3'] = $this->load->view('responsive_views/admin/users_end_painel', '', true);
            $this->load->view('view_admin', $data);
        }
    }

    public function list_filter_view_or_get_emails() {
        $this->load->model('class/user_role');
        if ($this->session->userdata('id') && $this->session->userdata('role_id')==user_role::ADMIN) {
            $this->load->model('class/admin_model');
            $form_filter = $this->input->get();
            $this->load->model('class/system_config');
            $GLOBALS['sistem_config'] = $this->system_config->load();
            $datas['SERVER_NAME'] = $GLOBALS['sistem_config']->SERVER_NAME;
            $datas['result'] = $this->admin_model->view_clients_or_get_emails_by_filter($form_filter);
            $datas['form_filter'] = $form_filter;
            $this->load->model('class/user_model');
            $this->user_model->insert_washdog($this->session->userdata('id'),'GET EMAILS');
            $query = 'SELECT DISTINCT utm_source FROM clients';
            $datas['utm_source_list'] = $this->user_model->execute_sql_query($query);
            $data['section1'] = $this->load->view('responsive_views/admin/admin_header_painel', '', true);
            $data['section2'] = $this->load->view('responsive_views/admin/admin_body_painel', $datas, true);
            $data['section3'] = $this->load->view('responsive_views/admin/users_end_painel', '', true);
            $this->load->view('view_admin', $data);
        } else{
            echo "Não pode acessar a esse recurso, deve fazer login!!";
        }
    }
    
    public function list_filter_view_pendences() {
        $this->load->model('class/user_role');
        if ($this->session->userdata('id') && $this->session->userdata('role_id')==user_role::ADMIN) {
            $this->load->model('class/user_model');
            $this->user_model->insert_washdog($this->session->userdata('id'),'VIEW PENDENCES');
            $this->load->model('class/admin_model');
            $form_filter = $this->input->get();
            $datas['result'] = $this->admin_model->view_pendences_by_filter($form_filter);
            $datas['form_filter'] = $form_filter;
            $data['section1'] = $this->load->view('responsive_views/admin/admin_header_painel', '', true);
            $data['section2'] = $this->load->view('responsive_views/admin/admin_body_painel_pendences', $datas, true);
            $data['section3'] = $this->load->view('responsive_views/admin/users_end_painel', '', true);
            $this->load->view('view_admin', $data);
        }
        else {
            echo "Não pode acessar a esse recurso, deve fazer login!!";
        }
    }
        
    public function reference_profile_view() {        
        $this->load->model('class/user_role');
        $this->load->model('class/client_model');
        $this->load->model('class/user_model');
        $this->load->library('external_services');
        if ($this->session->userdata('id') && $this->session->userdata('role_id')==user_role::ADMIN) {
            $id = $this->input->get()['id'];
            
            $sql = 'SELECT plane_id FROM clients WHERE user_id='.$id;
            $plane_id = $this->user_model->execute_sql_query($sql);
            $sql = 'SELECT * FROM plane WHERE id='.$plane_id[0]['plane_id'];
            $plane_datas = $this->user_model->execute_sql_query($sql);            
            $datas['plane_datas'] = $plane_datas[0]['to_follow'];
            
            $active_profiles = $this->client_model->get_client_active_profiles($id);
            $canceled_profiles = $this->client_model->get_client_canceled_profiles($id);            
            $datas['active_profiles'] = $active_profiles;
            $datas['canceled_profiles'] = $canceled_profiles;
            $datas['my_daily_work'] = $this->get_daily_work($active_profiles); 
            
            $datas['followed_today'] =  $this->external_services->get_number_followed_today($id);            
            $data['section1'] = $this->load->view('responsive_views/admin/admin_header_painel', '', true);
            $data['section2'] = $this->load->view('responsive_views/admin/admin_body_painel_reference_profile', $datas, true);
            $data['section3'] = $this->load->view('responsive_views/admin/users_end_painel', '', true);
            $this->load->view('view_admin', $data);
        } else{
            echo "Não pode acessar a esse recurso, deve fazer login!!";
        }
    }
    
    public function desactive_client() {
        $this->load->model('class/user_role');
        if ($this->session->userdata('id') && $this->session->userdata('role_id')==user_role::ADMIN) {
            $this->load->model('class/user_model');
            $this->load->model('class/user_status');
            $id = $this->input->post()['id'];
            try {
                $this->delete_work_of_client($id);              
                $this->user_model->update_user($id, array(
                    'status_id' => user_status::DELETED,
                    'end_date' => time()));
                $this->user_model->insert_washdog($id,'CLIENT DELETED FROM ADMIN');
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
                $result['success'] = false;
                $result['message'] = "Erro no banco de dados. Contate o grupo de desenvolvimento!";
            } finally {
                $result['success'] = true;
                $result['message'] = "Cliente desativado com sucesso!";
            }
            echo json_encode($result);
        } else{
            echo "Não pode acessar a esse recurso, deve fazer login!!";
        }
    }
    
    public function send_curl() {
        $this->load->model('class/user_role');
        $this->load->library('external_services');
        if ($this->session->userdata('id') && $this->session->userdata('role_id')==user_role::ADMIN) {
            $datas = $this->input->post();
            $client_id = $datas['client_id'];
            $curl = urldecode($datas['curl']);
            try {
                $this->external_services->set_client_cookies_by_curl($client_id, $curl, NULL);
            } catch (Exception $exc) {
                $result['success'] = false;
                $result['message'] = "Erro no banco de dados. Contate o grupo de desenvolvimento!";
            } finally {
                $result['success'] = true;
                $result['message'] = "cURL enviada com sucesso!";
            }
            echo json_encode($result);
        } else {
            echo "Não pode acessar a esse recurso, deve fazer login!!";
        }
    }
    
    public function clean_cookies() {
        $this->load->model('class/user_role');
        $this->load->model('class/client_model');
        if ($this->session->userdata('id') && $this->session->userdata('role_id')==user_role::ADMIN) {
            $client_id = $this->input->post()['client_id'];            
            try {
                $this->client_model->update_client($client_id, array('cookies' => ''));
            } catch (Exception $exc) {
                $result['success'] = false;
                $result['message'] = "Erro no banco de dados. Contate o grupo de desenvolvimento!";
            } finally {
                $result['success'] = true;
                $result['message'] = "Cookies limpadas com sucesso!";
            }
            
            echo json_encode($result);
        } else {
            echo "Não pode acessar a esse recurso, deve fazer login!!";
        }
    }
    
    //---- Functions to PENDENCES------------------------------
    public function create_pendence() {
        $this->load->model('class/user_role');
        if ($this->session->userdata('id') && $this->session->userdata('role_id')==user_role::ADMIN) {
            $this->load->model('class/admin_model');
            $form_filter = $this->input->get();
            $datas['result'] = $this->admin_model->create_pendence_by_form($form_filter);
            $datas['form_filter'] = $form_filter;
            $data['section1'] = $this->load->view('responsive_views/admin/admin_header_painel', '', true);
            $data['section2'] = $this->load->view('responsive_views/admin/admin_body_painel_pendences', $datas, true);
            $data['section3'] = $this->load->view('responsive_views/admin/users_end_painel', '', true);
            $this->load->view('view_admin', $data);
        }
        else {
            echo "Não pode acessar a esse recurso, deve fazer login!!";
        }
    }
    
    public function update_pendence() {
        $this->load->model('class/user_role');
        if ($this->session->userdata('id') && $this->session->userdata('role_id')==user_role::ADMIN) {
            $this->load->model('class/admin_model');
            $form_filter = $this->input->get();
            $datas['result'] = $this->admin_model->update_pendence($form_filter);
            $datas['form_filter'] = $form_filter;
            $data['section1'] = $this->load->view('responsive_views/admin/admin_header_painel', '', true);
            $data['section2'] = $this->load->view('responsive_views/admin/admin_body_painel_pendences', $datas, true);
            $data['section3'] = $this->load->view('responsive_views/admin/users_end_painel', '', true);
            $this->load->view('view_admin', $data);
        }
        else {
            echo "Não pode acessar a esse recurso, deve fazer login!!";
        }
    }
    
    public function resolve_pendence() {
        $this->load->model('class/user_role');
        if ($this->session->userdata('id') && $this->session->userdata('role_id')==user_role::ADMIN) {
            $this->load->model('class/admin_model');
            $form_filter = $this->input->get();
            $datas['result'] = $this->admin_model->resolve_pendence($form_filter);
            $datas['form_filter'] = $form_filter;
            $data['section1'] = $this->load->view('responsive_views/admin/admin_header_painel', '', true);
            $data['section2'] = $this->load->view('responsive_views/admin/admin_body_painel_pendences', $datas, true);
            $data['section3'] = $this->load->view('responsive_views/admin/users_end_painel', '', true);
            $this->load->view('view_admin', $data);
            
        }
        else {
            echo "Não pode acessar a esse recurso, deve fazer login!!";
        }
    }

    public function recorrency_cancel() {
        $result['success'] = false;
        $result['message'] = 'Cancele diretamente na Vindi';
        echo json_encode($result);
    }

    public function pendences() {
        $this->load->model('class/user_role');
        if ($this->session->userdata('id') && $this->session->userdata('role_id')==user_role::ADMIN) {
            $data['section1'] = $this->load->view('responsive_views/admin/admin_header_painel', '', true);
            $data['section2'] = $this->load->view('responsive_views/admin/admin_body_painel_pendences', '', true);
            $data['section3'] = $this->load->view('responsive_views/admin/users_end_painel', '', true);
            $this->load->view('view_admin', $data);
        }
        else {
            echo "Não pode acessar a esse recurso, deve fazer login!!";
        }
    }
    
    //---- Functions to watchdog-----------------------------
    public function watchdog() {
        $this->load->model('class/user_role');
        if ($this->session->userdata('id') && $this->session->userdata('role_id')==user_role::ADMIN) {
            $data['section1'] = $this->load->view('responsive_views/admin/admin_header_painel', '', true);
            $data['section2'] = $this->load->view('responsive_views/admin/admin_body_painel_watchdog', '' , true);
            $data['section3'] = $this->load->view('responsive_views/admin/users_end_painel', '', true);
            $this->load->view('view_admin', $data);
        }
        else {
            echo "Não pode acessar a esse recurso, deve fazer login!!";
        }
    }
    
    public function list_filter_view_watchdog() {
        $this->load->model('class/user_role');
        if ($this->session->userdata('id') && $this->session->userdata('role_id')==user_role::ADMIN) {
            $this->load->model('class/admin_model');
            $form_filter = $this->input->get();
            $datas['result'] = $this->admin_model->view_watchdog_by_filter($form_filter);
            $datas['form_filter'] = $form_filter;
            
            $daily_report = $this->get_daily_report($form_filter['user_id']);
            $datas['followings'] = $daily_report['followings'];
            $datas['followers']  = $daily_report['followers'];
            
            $data['section1'] = $this->load->view('responsive_views/admin/admin_header_painel', '', true);
            $data['section2'] = $this->load->view('responsive_views/admin/admin_body_painel_watchdog', $datas, true);
            $data['section3'] = $this->load->view('responsive_views/admin/users_end_painel', '', true);
            $this->load->view('view_admin', $data);
        } else{
            echo "Não pode acessar a esse recurso, deve fazer login!!";
        }
    }
    
    public function get_daily_report($id) {
        $this->load->model('class/user_model');
        $sql = "SELECT * FROM daily_report WHERE followings != '0' AND followers != '0' AND client_id=" . $id . " ORDER BY date ASC;" ;  // LIMIT 30
        $result = $this->user_model->execute_sql_query($sql);
        $followings = array();
        $followers = array();
        $N = count($result);
        for ($i = 0; $i < $N; $i++) {
            if(isset($result[$i]['date'])){
            $dd = date("j", $result[$i]['date']);
            $mm = date("n", $result[$i]['date']);
            $yy = date("Y", $result[$i]['date']);
            $followings[$i] = (object) array('x' => ($i+1), 'y' => intval($result[$i]['followings']), "yy" => $yy, "mm" => $mm, "dd" => $dd);
            $followers[$i] = (object) array('x' => ($i + 1), 'y' => intval($result[$i]['followers']), "yy" => $yy, "mm" => $mm, "dd" => $dd);
            }
        }
        $response= array(
            'followings' => json_encode($followings),
            'followers' => json_encode($followers)
        );
        return $response;
    }
    
    //---- Functions to basic operations-----------------------------
    public function change_ticket_peixe_urbano_status_id() {
        $this->load->model('class/user_role');
        if ($this->session->userdata('id') && $this->session->userdata('role_id')==user_role::ADMIN){
            $this->load->model('class/client_model');
            $datas=$this->input->post();
            if($this->client_model->update_cupom_peixe_urbano_status($datas)){
                $result['success'] = true;
                $result['message'] = 'Stauts de Cupom atualizado corretamente';
            } else{
                $result['success'] = false;
                $result['message'] = 'Erro actualizando status do Cupom';
            }
            echo json_encode($result);
        } else{
            echo "Não pode acessar a esse recurso, deve fazer login!!";
        }
    }
    
    public function change_pay_day_peixe_urbano(){
        $this->load->model('class/admin_model');
        $datas = $this->input->post();
        list ($mes, $dia, $ano) = explode ('/', $datas['pu_new_date']);
        $pay_day = strtotime($mes."/".$dia."/".$ano." 14:00:00");
        $client_id = $datas['client_id'];
        $resp = $this->admin_model->change_pay_day($client_id, $pay_day);
        
        if ($resp) {
            $response['success'] = true;
            $response['message'] = "Data modificada corretamente";
        } else {
            $response['success'] = false;
            $response['message'] = "Erro, não foi possível alterar a data de pagamento do cliente, contate ao grupo de desenvolvimento";
        }
        
        echo json_encode($response);
    }
    
    public function do_payments() {
        $this->load->model('class/user_role');
        if ($this->session->userdata('id') && $this->session->userdata('role_id')==user_role::ADMIN) {
            $data['section1'] = $this->load->view('responsive_views/admin/admin_header_painel', '', true);
            $data['section2'] = $this->load->view('responsive_views/admin/do_payments_view', '' , true);
            $data['section3'] = $this->load->view('responsive_views/admin/users_end_painel', '', true);
            $this->load->view('view_admin', $data);
        }
        else {
            echo "Não pode acessar a esse recurso, deve fazer login!!";
        }                
    }
    
    public function do_payment_at_moment() {
        $this->load->model('class/admin_model');
        $this->load->model('class/client_model');
        $this->load->model('class/Crypt');
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();        
        $datas = $this->input->post();
        $client_id = $datas['payment_now_client_id'];
        $value = $datas['payment_now_value'];
        $client = $this->client_model->get_client_by_id($client_id)[0];        
        if($client['observation']!='Cartão inválido'){
            $response['success'] = false;
            $response['message'] = "Esse cartão já foi coferido como inválido na Vindi";
        }else            
        if(!$this->client_model->is_vindi_client($client['user_id'])){
            $response['success'] = false;
            $response['message'] = "Esse cartão já foi coferido como inválido na Vindi";
        }else{
            $resp = $this->check_mundipagg_credit_card($payment_data);
            if (is_object($resp) && $resp->isSuccess() && 
                $resp->getData()->CreditCardTransactionResultCollection[0]->CapturedAmountInCents > 0) {
                $this->client_model->update_client($client_id, array(
                    'initial_order_key' => $resp->getData()->OrderResult->OrderKey,
                    'pay_day' => strtotime("+1 month", time())));  
                $response['success'] = true;
                $response['message'] = "Cobrança na hora bem sucedida";
            } else {
                $response['success'] = false;
                $response['message'] = "Erro, não foi possível fazer a cobrança";
            }            
        }
        echo json_encode($response);
    }
    
    public function do_new_recurrency() {
        $this->load->model('class/admin_model');
        $this->load->model('class/client_model');
        $this->load->model('class/Crypt');
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        
        $datas = $this->input->post();        
        $client_id = $datas['recurrency_user_id'];
        $value = $datas['recurrency_value'];
        list ($mes, $dia, $ano) = explode ('/', $datas['recurrency_date']);
        $pay_day = strtotime($mes."/".$dia."/".$ano." 14:00:00");
        $client = $this->client_model->get_client_by_id($client_id)[0];
        
        $payment_data['credit_card_number'] = $this->Crypt->decodify_level1($client['credit_card_number']);
        $payment_data['credit_card_cvc'] = $this->Crypt->decodify_level1($client['credit_card_cvc']);
        $payment_data['credit_card_name'] = $client['credit_card_name'];
        $payment_data['credit_card_exp_month'] = $client['credit_card_exp_month'];
        $payment_data['credit_card_exp_year'] = $client['credit_card_exp_year'];
        $payment_data['amount_in_cents'] = $value;
        $payment_data['pay_day'] = $pay_day;
        
        $resp = $this->check_recurrency_mundipagg_credit_card($payment_data, 0);
        if (is_object($resp) && $resp->isSuccess()) {
            $this->client_model->update_client($client_id, array(
                'order_key' => $resp->getData()->OrderResult->OrderKey,
                'pay_day' => $pay_day,
                'actual_payment_value' => $value));
            $response['success'] = true;
            $response['message'] = "Recorrência criada com sucesso";
        } else {
            $response['success'] = false;
            $response['message'] = "Erro, não foi possível fazer a recorrência";
        }
        
        echo json_encode($response);
    }
    
    public function do_change_status_client() {
        $this->load->model('class/user_model');
        $this->load->model('class/user_status');
        $this->load->model('class/client_model');
        $datas = $this->input->post();
        $client_id = $datas['change_status_user_id'];
        $new_status = $datas['change_status_selected'];
        $resp = false;
        $this->delete_work_of_client($client_id);
        
        // Trocar status si status actual del cliente es distinto de BEGINNER y de DELETED.
        $user_data = $this->user_model->get_user_by_id($client_id);
        $actual_status = $user_data[0]['status_id'];
        
        if ($actual_status != null && $actual_status != user_status::DELETED && $actual_status != user_status::BEGINNER) {
            //1. setting to Blocked by Payment
            if (!$resp && $new_status == user_status::BLOCKED_BY_PAYMENT) {
                $resp = $this->user_model->update_user($client_id, array(
                    'status_id' => user_status::BLOCKED_BY_PAYMENT));
            } else
            //2. setting to Blocked by Instagram
            if (!$resp && $new_status == user_status::BLOCKED_BY_INSTA) {
                $resp = $this->user_model->update_user($client_id, array(
                    'status_id' => user_status::BLOCKED_BY_INSTA));
            } else
            //3. setting to Verify Account
            if (!$resp && $new_status == user_status::VERIFY_ACCOUNT) {
                $resp = $this->user_model->update_user($client_id, array(
                    'status_id' => user_status::VERIFY_ACCOUNT));
            }
            if ($resp) {
                $response['success'] = true;
                $response['message'] = "Status mudado corretamente";
            } else {
                $response['success'] = false;
                $response['message'] = "Impossível mudar o status";
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Não pode mudar o status de um usuário BEGINNER ou DELETED";
        }
        
        echo json_encode($response);
    }
    
    public function update_vindi_datas() {
        $this->load->model('class/client_model');
        if(isset($this->input->post()['customer_id']) && $this->input->post()['customer_id']!="")
            $datas['gateway_client_id'] = $this->input->post()['customer_id'];
        if(isset($this->input->post()['signature_id']) && $this->input->post()['signature_id']!="")
            $datas['payment_key'] = $this->input->post()['signature_id'];
        try {
            if(count($this->client_model->get_vindi_payment($this->input->post()['user_id']))){
                if($this->client_model->update_client_payment($this->input->post()['user_id'], $datas)){
                    $response['success'] = true;
                    $response['message'] = "Dados atualizados com sucesso";
                }else{
                    $response['success'] = false;
                    $response['message'] = "Erro ao atualizar dados da Vindi para esse usuário";
                }                
            }else{
                $response['success'] = false;
                $response['message'] = "Esse usuário não possui dados na tabela client_payment do banco de dados. Informe ao desenvolvimento inserir manualmente esses dados";
            }            
        } catch (Exception $exc) {
            $response['success'] = false;
            $response['message'] = "Erro acessando ao banco de dados. Informe ao grupo de desnvolvimento";
        }
        echo json_encode($response);
    }
    
    public function update_proxy() {
        $this->load->model('class/client_model');                
        $id = $this->input->post()['user_id'];
        $datas['proxy'] = $this->input->post()['new_proxy'];        
        if($this->client_model->update_client($id, $datas)){
            $response['success'] = true;
            $response['message'] = "Proxy atualizado com sucesso";
        }else{
            $response['success'] = false;
            $response['message'] = "Erro atualizando proxy";
        }
        echo json_encode($response);
    }
    
    //---- Functions auxiliars-----------------------------
    public function T($token, $array_params=NULL, $lang=NULL) {
        if(!$lang){
            $this->load->model('class/system_config');
            $GLOBALS['sistem_config'] = $this->system_config->load();
            if(isset($language['language']))
                $param['language']=$language['language'];
            else
                $param['language'] = $GLOBALS['sistem_config']->LANGUAGE;
            $param['SERVER_NAME'] = $GLOBALS['sistem_config']->SERVER_NAME;        
            $GLOBALS['language']=$param['language'];
            $lang=$param['language'];
        }
        $this->load->model('class/translation_model');
        $text = $this->translation_model->get_text_by_token($token,$lang);
        $N = count($array_params);
        for ($i = 0; $i < $N; $i++) {
            $text = str_replace('@' . ($i + 1), $array_params[$i], $text);
        }
        return $text;
    }
       
    public function delete_work_of_client($client_id) {
        $this->load->model('class/client_model');
        $active_profiles = $this->client_model->get_client_workable_profiles($client_id);        
        $N = count($active_profiles);
        for ($i = 0; $i < $N; $i++) {
            $this->client_model->delete_work_of_profile($active_profiles[$i]['id']);
        }
        return true;
    }
    
    public function detectCardType($num) {
        $re = array(
            "visa" => "/^4[0-9]{12}(?:[0-9]{3})?$/",
            "mastercard" => "/^5[1-5][0-9]{14}$/",
            "amex" => "/^3[47][0-9]{13}$/",
            "discover" => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
            "diners" => "/^3[068]\d{12}$/",
            "elo" => "/^((((636368)|(438935)|(504175)|(451416)|(636297))\d{0,10})|((5067)|(4576)|(4011))\d{0,12})$/",
            "hipercard" => "/^(606282\d{10}(\d{3})?)|(3841\d{15})$/"
        );

        if (preg_match($re['visa'], $num)) {
            return 'Visa';
        } else if (preg_match($re['mastercard'], $num)) {
            return 'Mastercard';
        } else if (preg_match($re['amex'], $num)) {
            return 'Amex';
        } else if (preg_match($re['discover'], $num)) {
            return 'Discover';
        } else if (preg_match($re['diners'], $num)) {
            return 'Diners';
        } else if (preg_match($re['elo'], $num)) {
            return 'Elo';
        } else if (preg_match($re['hipercard'], $num)) {
            return 'Hipercard';
        } else {
            return false;
        }
    }
    
    public function get_daily_work($active_profiles) {
        $this->load->model('class/client_model');
        $this->load->model('class/user_role');
        $n = count($active_profiles);
        $my_daily_work = array();
        //if($this->session->userdata('id') && $this->session->userdata('role_id')==user_role::ADMIN){
            for ($i = 0; $i < $n; $i++){
                $work = $this->client_model->get_daily_work_to_profile($active_profiles[$i]['id']);
                if (count($work)) {
                    $work = $work[0];
                }
                if (count($work)) {
                    $to_follow = $work['to_follow'];
                    $to_unfollow = $work['to_unfollow'];
                } else {
                    $to_follow = '----';
                    $to_unfollow = '----';
                }
                $tmp = array('profile' => $active_profiles[$i]['insta_name'],
                    'id' => $active_profiles[$i]['id'],
                    'to_follow' => $to_follow,
                    'to_unfollow' => $to_unfollow,
                    'end_date' => $active_profiles[$i]['end_date']
                );
                $my_daily_work[$i] = $tmp;
            }
        return $my_daily_work;
    }
    
    public function dumbu_statistics_view() {
        $this->load->model('class/user_role');
        $this->load->model('class/user_status');
        $this->load->model('class/admin_model');
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        if ($this->session->userdata('id') && $this->session->userdata('role_id')==user_role::ADMIN) {
            $param = $this->input->post();
            $datas['DATAS'] = $this->admin_model->get_dumbu_statistic($param);
            $data['section1'] = $this->load->view('responsive_views/admin/admin_header_painel', '', true);
            $data['section2'] = $this->load->view('responsive_views/admin/admin_body_painel_dumbu_statistics', $datas, true);
            $data['section3'] = $this->load->view('responsive_views/admin/users_end_painel', '', true);
            $this->load->view('view_admin', $data);
        } else{
            echo "Não pode acessar a esse recurso, deve fazer login!!";
        }
    }
    
    
    
}
