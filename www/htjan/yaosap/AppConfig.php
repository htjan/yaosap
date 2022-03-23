<?php
namespace htjan\yaosap;

//use htjan\yaosap\Autoload;
//use htjan\common\Error\ErrorManager;

use htjan\common\Error\ErrorManager;
use htjan\common\Autoload;

class AppConfig {
    /*Application Directories*/
    const PROJECT_NAME              = 'yaosap'; 
    
    const ROOT_DIR                  = '/var/www/html/htjan/'.self::PROJECT_NAME.'/www';
    
    const ROOT_URL                  = 'https://'.self::PROJECT_NAME.'.com';
    
    const IMPORT_IN_DIR             = self::ROOT_DIR.'/imp/in';
    const IMPORT_OUT_DIR            = self::ROOT_DIR.'/imp/out';
    const CLASSES_DIR_PROJECT       = self::ROOT_DIR.'/htjan/'.self::PROJECT_NAME;
    const CLASSES_DIR_COMMON        = self::ROOT_DIR.'/htjan/common';
    
    /* Certificate and key for curl operations in ErrorManager */

    const SSLCERT_PATH              = '/etc/letsencrypt/live/'.self::PROJECT_NAME.'/cert.pem';
    const SSLCERTFULL_PATH          = '/etc/letsencrypt/live/'.self::PROJECT_NAME.'/fullchain.pem';
    const PRIVKEY_PATH              = '/etc/letsencrypt/live/'.self::PROJECT_NAME.'/privkey.pem';
    const PRIVKEY_PASSWORD_PATH     = '/var/www/cert/'.self::PROJECT_NAME.'.net/privkey-password.txt';

    /* Autoload class 
     * Used in this file, see below*/
    const AUTOLOAD_FILE             = self::CLASSES_DIR_COMMON.'/Autoload.php';
    
    /* Error handler class
    * Used in this file, see below*/
    const ERROR_HANDLER_FILE         = self::CLASSES_DIR_COMMON.'/Error/ErrorManager.php';
    const ERROR_DISPLAYER_FILE       = self::CLASSES_DIR_COMMON.'/Error/ErrorDisplayer.php';
    
    /* Namespaces used*/
    const APP_NAMESPACES            = array(
                                            array(
                                                'name' => 'common',
                                                'root' => 'htjan\common',
                                                'dir'  => '/var/www/html/htjan/common/www/cls'
                                                
                                            ),
                                            array(
                                                'name' => self::PROJECT_NAME,
                                                'root' => 'htjan\\'.self::PROJECT_NAME,
                                                'dir'  => self::CLASSES_DIR
                                            )
                                       );
    
    const ERROR_MESSAGE            = array (
                                            0   => 'Can\'t get the content of requested page',
                                            1   => 'Argument provided isn\'t an positive integer',
                                            2   => 'Argument provided isn\'t an integer',
                                            3   => 'Argument provided isn\'t a string',
                                            4   => 'Argument provided isn\'t a valid email',
                                            5   => 'Type provided isn\'t valid',
                                            6   => 'Empty string provided',
                                            7   => 'Wrong type of data provided, expecting ',
                                            8   => 'Http Method expected : GET or POST ',
                                            9   => 'Argument provided isn\'t a valid URL',
                                            10  => 'Argument provided isn\'t a valid array',
                                            11  => 'Can\'t create http request context',
                                            12  => 'Can\'t get the content of the requested file',
                                            13  => 'Page doesn\'t exists',
                                            /*Operation Raw Data*/
                                            30  => 'Can\'t create a new item',
                                            31  => 'Can\'t read an item',
                                            32  => 'Can\'t update an item',
                                            33  => 'Can\'t get the last inserted item\'s id',
                                            40  => 'Can\'t read the id list Raw',
        
        
                                            // Application errors 
                                            1000    => 'Can\'t get the requested error message',
                                            1100    => 'Server error'
        
    ); 
    
    /* Application urls */
    /*Error Managment*/
    const ERROR_URL                 = self::ROOT_URL.'/htm/common/error_page.php';
    const ERROR_METHOD              = 'GET';
    const ERROR_DISPLAY_MODE        = 'page';
    
    
    const WEB_ROOT_URL              = self::ROOT_DIR.'/htm';
    const WEB_ROOT_URL_COMMON       = self::ROOT_DIR.'/htm/common';
    const WEB_ROOT_URL_PROJECT      = self::ROOT_DIR.'/htm/'.self::PROJECT_NAME;
    const WEB_INCLUDE_URL           = self::WEB_ROOT_PATH.'/inc';
    
    const WEB_PAGE            = array (
        'default'                        => self::WEB_ROOT_URL_PROJECT.'/default.php',
        'transactions_list'              => self::WEB_ROOT_URL_PROJECT.'/Operation/operation_list.php',
        'transactions_raw_list'          => self::WEB_ROOT_URL_PROJECT.'/Operation/operation_raw_list_display.php',
        'transactions_raw_list_upload'   => self::WEB_ROOT_URL_PROJECT.'/Operation/operation_raw_list_upload.php',
        'test'                           => self::WEB_ROOT_URL_PROJECT.'/test.php',
        
        ''                      => self::WEB_ROOT_URL_PROJECT.'/default.php'
    ); 
    
    const DATABASE_HOST             = '127.0.0.1';
    const DATABASE_PORT             = '3306';
    const DATABASE_NAME             = 'yaosap';
    const DATABASE_USER             = 'yaosap';
    const DATABASE_PASSWORD         = 'nc';
    
    /*Max items displayed on lists*/
    const MAX_ITEM_PER_PAGE         = 50;
    const MAX_PAGES_PER_SLIDE       = 5;
    
    public static function main(){
        return (
                    self::registerAutoload() 
                //&&  self::registerErrorHandler()
        );
    }
    
    public static function registerAutoload(){
        
        if(!file_exists(self::AUTOLOAD_FILE) ||  !require_once(self::AUTOLOAD_FILE)) {
            echo ("<p>Error : Autoload file is not recheable</p>");
            return false;
        } elseif (!($autoload = new Autoload()) ||  is_null($autoload->register(self::ROOT_DIR))) {
            echo ("<p>Error : Autoload cant' be registered</p>");
            return false;
        } else {
            return true;
        }

    }
    
    public static function registerErrorHandler(){

        if(!file_exists(self::ERROR_HANDLER_FILE) || !require_once(self::ERROR_HANDLER_FILE)) {
            echo ("<p>Error : Error Manager file is not recheable</p>");
            return false;
        } elseif(!file_exists(self::ERROR_DISPLAYER_FILE) || !require_once(self::ERROR_DISPLAYER_FILE)) {
            echo ("<p>Error : Error Displayer file is not recheable</p>");
            return false;
        } elseif (!($error_manager = New ErrorManager())){
            echo ("<p>Error : Error Manager can't be registered 1</p>");
            return false;
        } elseif ($error_manager->register()) {
            echo ("<p>Error : Error Manager can't be registered 2</p>");
            return false;
        } else {
            return true;
        }
    }
    
}


?>
