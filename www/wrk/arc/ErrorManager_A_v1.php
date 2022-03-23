<?php
namespace htjan\yaosap\utl;

require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'].'cls/utl/AppConfig.php');

class ErrorManager {
    
    /* ErrorManager Strings */
    const YOASAA_ERR_HANDLER                                = "An error occured with the error handler";
    const YOASAA_ERR_CLS_FILEIMPORTLIST_NOT_A_VALID_DIR     = "Import file directory path provided isn't a valid directory ressource";
    const YOASAA_ERR_CLS_FILEIMPORTLIST_0                   = "Import file directory path provided isn't a valid directory ressource";
    
    
    public  $error_page_url     = AppConfig::YAOSAP_ERROR_PAGE_URL;
    
    public  $error_string       = '';
    public  $file_name          = '';
    public  $class_name         = '';
    
    
    function __construct( $error_string, $file_name = '', $class_name = '' ){
        
        $this->error_string     = $error_string;
        $this->file_name        = $file_name;
        $this->class_name       = $class_name;
    
    }
    
    
    function setErrorPage() {
                
        /* Get app constants */
        $error_page             = AppConfig::YAOSAP_ERROR_PAGE_URL;
        $ssl_cert               = AppConfig::YAOSAP_SSLCERT_PATH;
        $private_key            = AppConfig::YAOSAP_PRIVKEY_PATH;
        $private_key_password   = AppConfig::YAOSAP_PRIVKEY_PASSWORD_PATH;
        
        $error_data             = array (   'error' =>  $this->error_string, 
                                            'file'  =>  $this->file_name,
                                            'class' =>  $this->class_name );
        
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
    

    function getErrorPage($error_string = '', $file_name = '', $class_name = '')
    {
        
        $curl_handler=self::setErrorPage($error_string = '', $file_name = '', $class_name = '');
        
        $result = curl_exec($curl_handler);
        
        /* Get URL */
        if( ! $result )
        {
            trigger_error(curl_error($curl_handler));
        }
        
        /* Terminate curl session*/
        curl_setopt($curl_handler, CURLOPT_FORBID_REUSE, true);
        curl_close($curl_handler);
    }
            
}

?>