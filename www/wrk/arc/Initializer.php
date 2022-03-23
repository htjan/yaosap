<?php

namespace htjan\yaosaa\ctl;

use htjan\yaosap\ctl\Autoload;
use htjan\yaosap\mdl\AppConfig;

class Initializer {
    
    private $app_config_object;
    private $app_config;
    
    public function __construct () {
        require_once ( $_SERVER['CONTEXT_DOCUMENT_ROOT'].'cls/ctl/Autoload.php' );
        Autoload::register();
    
        $this->app_config_object   = new AppConfig();
        $this->app_config         = $this->app_config_object->getParameters();
    }
    
    public function getValue ($param) {
        
        return $this->app_config_object->getValue($param);
        
    }
    
    public function getParameters () {
        
        $this->app_config           = $this->app_config_object->getParameters();
        return $this->app_config;
        
    }
    
}




?>