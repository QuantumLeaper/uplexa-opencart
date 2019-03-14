<?php

    class ControllerExtensionPaymentuPlexa extends Controller {
        private $payment_module_name  = 'uplexa';
        public function index() {

            //$this->load->model('payment/uplexa');
            $this->load->model('checkout/order');
            $order_id = $this->session->data['order_id'];
            $order = $this->model_checkout_order->getOrder($order_id);
            $current_default_currency = $this->config->get('config_currency');
            $order_total = $order['total'];
            $order_currency = $this->session->data['currency'];
            $amount_upx = $this->changeto($order_total, $order_currency);
            $payment_id = $this->set_paymentid_cookie();

            $data['amount_upx'] = $amount_upx;

            $data['integrated_address'] = $this->make_integrated_address($payment_id);
            $address = $this->config->get("payment_uplexa_address");
            $data['url'] = "uplexa:" . $data['integrated_address'] . "?tx_amount=" . $amount_upx;
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/extension/payment/uplexa.twig')) {
                $this->template = $this->config->get('config_template') . '/template/extension/payment/uplexa.twig';
            } else {
                $this->template = 'default/template/extension/payment/uplexa.twig';
            }

            if($this->verify_payment($payment_id, $data['amount_upx']))
            {
                $this->model_checkout_order->addOrderHistory($order_id, 2, 'uPlexa payment received');
            }

            return $this->load->view('extension/payment/uplexa', $data);

        }

        public function changeto($order_total, $currency){
            $upx_live_price = $this->upxliveprice($currency);
            $amount_in_upx = $order_total / $upx_live_price ;
            return $amount_in_upx;
        }

        public function upxliveprice($currency){
            $url = "https://uplexa.com/data?currencies=BTC,USD,EUR,CAD,INR,GBP&extraParams=uplexa_opencart";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            $data = curl_exec($curl);
            curl_close($curl);
            $price = json_decode($data, TRUE);

            switch ($currency) {
                case 'USD':
                    return $price['USD'];
                case 'EUR':
                    return $price['EUR'];
                case 'CAD':
                    return $price['CAD'];
                case 'GBP':
                    return $price['GBP'];
                case 'INR':
                    return $price['INR'];
                case 'UPX':
                    $price = '1';
                    return $price;
            }
        }

        private function set_paymentid_cookie()
        {
            if (!isset($_COOKIE['payment_id'])) {
                $payment_id = bin2hex(openssl_random_pseudo_bytes(8));
                setcookie('payment_id', $payment_id, time() + 2700);
            }
            else{
                $payment_id = $_COOKIE['payment_id'];
            }
            return $payment_id;
        }

        private function make_integrated_address($payment_id){

            $host = $this->config->get("payment_uplexa_wallet_rpc_host");
            $port = $this->config->get("payment_uplexa_wallet_rpc_port");
            $uplexa = new uplexa($host, $port);
            $integrated_address = $uplexa->make_integrated_address($payment_id);
            return $integrated_address["integrated_address"];
        }

        private function verify_payment($payment_id, $amount)
        {
            /*
             * function for verifying payments
             * Check if a payment has been made with this payment id then notify the merchant
             */

            $host = $this->config->get("payment_uplexa_wallet_rpc_host");
            $port = $this->config->get("payment_uplexa_wallet_rpc_port");

            $uplexa_daemon = new uplexa($host, $port);

            $amount_atomic_units = $amount * 100;
            $get_payments_method = $uplexa_daemon->get_payments($payment_id);
            if(isset($get_payments_method["payments"][0]["amount"]))
            {
                if($get_payments_method["payments"][0]["amount"] >= $amount_atomic_units)
                {
                    $confirmed = true;
                }
            }
            else
            {
                $confirmed = false;
            }
            return $confirmed;
        }

    }
