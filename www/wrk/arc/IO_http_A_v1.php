<?php

class IO_http {
    
    private $url = "";
    
    function __construct($url, $post_data = '', $get_data = '' ){
        
        $this->url          = $url;
        $this->post_data    = $post_data;
        $this->get_data     = $get_data;
        
    }
    
    function setPage() {
        
        /* Get app constants */
        $ssl_cert               = AppConfig::YAOSAP_SSLCERT_PATH;
        $private_key            = AppConfig::YAOSAP_PRIVKEY_PATH;
        $private_key_password   = AppConfig::YAOSAP_PRIVKEY_PASSWORD_PATH;
        
        /* Initiate a curl session */
        $curl_handler = curl_init();
        
        /* Set options :
         * Provide the path to SSL Certificate
         * Error variables send by post
         * Provide error information
         * */
        curl_setopt($curl_handler, CURLOPT_URL,             $error_page                             );
        curl_setopt($curl_handler, CURLOPT_POST,            true                                    );
        curl_setopt($curl_handler, CURLOPT_POSTFIELDS,      $error_data                             );
        curl_setopt($curl_handler, CURLOPT_SSL_VERIFYPEER,  true                                    );
        curl_setopt($curl_handler, CURLOPT_SSLCERT,         $ssl_cert                               );
        curl_setopt($curl_handler, CURLOPT_SSLKEY,          $private_key                            );
        curl_setopt($curl_handler, CURLOPT_SSLKEYPASSWD,    file_get_contents($private_key_password));
        
        return $curl_handler;
        
    }
}



?>