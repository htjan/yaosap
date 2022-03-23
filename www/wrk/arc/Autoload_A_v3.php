<?php
namespace htjan\yaosap\cls\ctl;

/**
 * Class Autoloader
 */
class Autoload{
    
    //define CLASS_ROOT
    
    /**
     * Enregistre notre autoloader
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    
    /**
     * Inclue le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    static function autoload($class){
    {
            //use $class;
            echo("<p>Class : ".$class."</p>");
            
            $class_name = $class;
            //$class_name = str_replace($class_name . '\\', '', $class);
            $class_name = str_replace('htjan\\yaosap\\cls\\', '', $class_name);
            $class_name = str_replace('\\', '/', $class_name);
            
            echo("<p>Class Name : ".$class_name."</p>");
            
            // Directory containing The classes
            $class_dir  = $_SERVER['CONTEXT_DOCUMENT_ROOT']."cls";
            $class_file = $class_dir."/".$class_name.".php";
            
            
            //         echo ("<p>autoload_function used</p>");
            
            echo ("<p>Classes directory : ".$class_dir."</p>");
            echo ("<p>Classes File : ".$class_file."</p>");
            
            
            // Directories 3-tier hierarchy
            $tier_dirs  = array_diff(scandir($class_dir), array('.', '..'));
            //         echo ("<p> Tiers Directory : </p><p>".print_r($tier_dirs)."</p>");
            //         echo ("<p>Class name : ".$class_name."</p>");
            //         echo ("<p>Class dir : ".class_dir."</p>");
            //         echo ("<p>Tier dir : ".print_r(tier_dirs)."</p>");
            
            //require_once($class_file);
            

                
                
            if(file_exists($class_file))
            {
                if (require_once($class_file))
                {
                    //$use_namespace  = "htjan\\yaosap\\cls\\".$tier_dir."\\".$classname;
                    //                     $use_namespace  = "htjan\yaosap\cls\mdl\AppConfig";
                    //                     use $use_namespace
                    //
                    //use "htjan\yaosap\cls\mdl\AppConfig";
                    
                    //only require the class once, so quit after to save effort (if you got more, then name them something else
                        //                     echo "<p>Classe appellée : ".$class_file."</p>";
                    echo "<p>Fichier inclus : ".$class_file."</p>";
                    return true;
                }
                else
                {
                    echo "<p>Echec de l'inclusion du fichier : ".$class_file."</p>";
                    return false;
                }
            }
        }

        //require_once 'class/' . $class . '.php';
    
    
    }
    
}
