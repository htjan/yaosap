<?php

Class ErrorHandler { 
    
    /* ErrorHandler Strings */
    const YOASAA_ERR_CLS_FILEIMPORTLIST_0   = "Directory provided isn't a valid directory ressource";
    const YOASAA_ERR_HANDLER                = "Directory provided isn't a valid directory ressource";
    
    
    public  $error_page_url = AppConfig::YAOSAA_ERROR_PAGE_URL;
    
    public  $error_string       = '';
    public  $file_name          = '';
    public  $class_name         = '';


    function getErrorPage() {
        
        $error_data = array('error_string' => htmlentities($this->error_string), 'file_name' => htmlentities($this->file_name), 'class_name' => htmlentities($this->class_name));
        
        $options = array
        (
            /* use key 'http' even if you send the request to https: */
            'http' => array
            (
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($error_data)
            ),
            /* use key 'ssl' if website runs on https https: */
            'ssl' => array
            (
                'verify_peer'=>false,
                'verify_peer_name'=>false
            )
        );
        
        $context  = stream_context_create($options);
        $result = file_get_contents($this->error_page_url, false, $context);
        
        if ($result == false) {
            echo(self::YOASAA_ERR_HANDLER);
        }
        else
        {
            echo ($result);
        }
    }
}
?>
