<?php
namespace htjan\yaosap\WebUserInterface;

use htjan\yaosap\AppConfig;
use htjan\common\Error\ErrorManager;

class WebPage
{
    
    public $page_adress = '';

    public function __construct($page_name)
    {
        $this->setPage($page_name);
        $this->getPage();
    }
    
    public function setPage (string $page_name){
        
        /* Empty or wrong parameter
         * set parameter to default*/
        // TODO, corriger valeur par défaut, ne marche pas
        if(!isset($page_name) || $page_name == '' || !isset(AppConfig::WEB_PAGE[$page_name]) || AppConfig::WEB_PAGE[$page_name] == ''){
            AppConfig::WEB_PAGE['default'];
        }

        $this->page_adress = AppConfig::WEB_PAGE[$page_name];
    }
    
    public function getPage (){
        
        //echo($this->page_adress);
        if(!file_exists($this->page_adress)){
            echo ("<p>Page doesn\'t exists</p>");
            return false;
        }
        include $this->page_adress;
        return true;        
    }
    
}

