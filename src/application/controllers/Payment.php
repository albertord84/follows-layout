<?php
ini_set('xdebug.var_display_max_depth', 17);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 8024);

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    // No final deste arquivo estao exemplos de posts de notificação para teste
    public function vindi_notif_post() {
        $this->load->library('external_services');

        $post_str = file_get_contents('php://input');
        //COMMENT
        //charge_created sample
        //   $post_str = 's:1739:"{"event":{"type":"charge_created","created_at":"2018-07-30T17:09:11.141-03:00","data":{"charge":{"id":24847199,"amount":"49.88","status":"paid","due_at":"2018-07-30T23:59:59.000-03:00","paid_at":"2018-07-30T17:09:10.000-03:00","installments":1,"attempt_count":1,"next_attempt":null,"print_url":null,"created_at":"2018-07-30T17:09:08.000-03:00","updated_at":"2018-07-30T17:09:10.000-03:00","last_transaction":{"id":41100520,"transaction_type":"capture","status":"success","amount":"49.88","installments":1,"gateway_message":"Transacao capturada com sucesso","gateway_response_code":null,"gateway_authorization":"2521aece-93f7-49e9-a456-2658a3094a67","gateway_transaction_id":"976359a9-22a8-4c09-b8e9-799315ec8a8b","gateway_response_fields":{"tid":"10776296027EV9C100BB","authorization_code":"37H00Y","proof_of_sale":"514219","payment_id":"2521aece-93f7-49e9-a456-2658a3094a67"},"fraud_detector_score":null,"fraud_detector_status":null,"fraud_detector_id":null,"created_at":"2018-07-30T17:09:09.000-03:00","gateway":{"id":20929,"connector":"cielo_v3"},"payment_profile":{"id":7594486,"holder_name":"PEDRO BASTOS PETTII","registry_code":null,"bank_branch":null,"bank_account":null,"card_expiration":"2019-03-31T23:59:59.000-03:00","card_number_first_six":"516220","card_number_last_four":"7447","token":"ddb39cfc-2b88-4ab3-82c0-71c40f0429f0","created_at":"2018-07-30T17:08:51.000-03:00","payment_company":{"id":1,"name":"MasterCard","code":"mastercard"}}},"payment_method":{"id":25589,"public_name":"Cartão de crédito","name":"Cartão de crédito","code":"credit_card","type":"PaymentMethod::CreditCard"},"bill":{"id":25607761,"code":null},"customer":{"id":6951114,"name":"PEDRO BASTOS PETTII","email":"josergm86@gmail.com","code":null}}}}}";';
        //bill_paid sample
        //   $post_str = 's:2348:"{"event":{"type":"bill_paid","created_at":"2018-08-06T03:01:01.829-03:00","data":{"bill":{"id":25916748,"code":null,"amount":"49.0","installments":1,"status":"paid","seen_at":null,"billing_at":null,"due_at":"2018-08-06T23:59:59.000-03:00","url":"https://app.vindi.com.br/customer/bills/25916748?token=b1030b5a-f559-4108-98e3-93e51d3d379f","created_at":"2018-08-06T02:41:16.000-03:00","updated_at":"2018-08-06T03:01:01.753-03:00","bill_items":[{"id":31203570,"amount":"49.0","quantity":null,"pricing_range_id":null,"description":null,"pricing_schema":null,"product":{"id":231526,"name":"1 Real","code":null},"product_item":null,"discount":null}],"charges":[{"id":25149951,"amount":"49.0","status":"paid","due_at":"2018-08-06T23:59:59.000-03:00","paid_at":"2018-08-06T03:01:01.000-03:00","installments":1,"attempt_count":1,"next_attempt":null,"print_url":null,"created_at":"2018-08-06T02:41:16.000-03:00","updated_at":"2018-08-06T03:01:01.000-03:00","last_transaction":{"id":41682344,"transaction_type":"capture","status":"success","amount":"49.0","installments":1,"gateway_message":"Transacao capturada com sucesso","gateway_response_code":null,"gateway_authorization":"b3f8fe3e-339b-4b58-9dab-2490e40d5b79","gateway_transaction_id":"7cbc4a97-d429-4623-802d-0ced2caade6d","gateway_response_fields":{"tid":"10776296027F5QHNMR9B","authorization_code":"084257","proof_of_sale":"521087","payment_id":"b3f8fe3e-339b-4b58-9dab-2490e40d5b79"},"fraud_detector_score":null,"fraud_detector_status":null,"fraud_detector_id":null,"created_at":"2018-08-06T03:01:00.000-03:00","gateway":{"id":20929,"connector":"cielo_v3"},"payment_profile":{"id":7643678,"holder_name":"LIOMARA TEIXEIRA","registry_code":null,"bank_branch":null,"bank_account":null,"card_expiration":"2022-11-30T23:59:59.000-02:00","card_number_first_six":"491412","card_number_last_four":"9138","token":"e7b91584-9c2b-42d0-87b9-d4beee874ff5","created_at":"2018-08-03T21:56:39.000-03:00","payment_company":{"id":2,"name":"Visa","code":"visa"}}},"payment_method":{"id":25589,"public_name":"Cartão de crédito","name":"Cartão de crédito","code":"credit_card","type":"PaymentMethod::CreditCard"}}],"customer":{"id":6996637,"name":"LIOMARA TEIXEIRA","email":"carolguterrespd@gmail.com","code":null},"period":null,"subscription":null,"metadata":{},"payment_profile":null,"payment_condition":null}}}}";';
        //   $post_str = unserialize($post);
        //$post_str = json_decode($post_str);
        $result = $this->external_services->vindi_notif_post($post_str);
        
        //var_dump($result);

        print $result == "OK"? "OK" : "FAIL";
    }

    public function mundi_notif_post() {
        // Write the contents back to the file
        $path = __dir__ . '/../../logs/mundi';
        $file = $path . "mundi_notif_post-" . date("d-m-Y") . ".log";
        //$result = file_put_contents($file, "Albert Test... I trust God!\n", FILE_APPEND);
        $post = file_get_contents('php://input');
        $result = file_put_contents($file, serialize($post) . "\n\n", FILE_APPEND);
//        $result = file_put_contents($file, serialize($_POST['OrderStatus']), FILE_APPEND);
        if ($result === FALSE) {
            var_dump($file);
        }
        //var_dump($file);
        print 'OK';
    }

    public function mundi_notif_post_boleto() {
        // Write the contents back to the file
        $path = __dir__ . '/../../logs/';
        $file = $path . "mundi_notif_post-" . date("d-m-Y") . ".log";
        //$result = file_put_contents($file, "Albert Test... I trust God!\n", FILE_APPEND);
        $post = file_get_contents('php://input');
        $result = file_put_contents($file, serialize($post) . "\n\n", FILE_APPEND);
//        $result = file_put_contents($file, serialize($_POST['OrderStatus']), FILE_APPEND);
        if ($result === FALSE) {
            var_dump($file);
        }
        //var_dump($file);
        print 'OK';
    }

}