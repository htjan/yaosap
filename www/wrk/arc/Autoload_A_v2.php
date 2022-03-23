<?php
namespace htjan\yaosap\html\cls\ctl;

/**
 * Class Autoloader
 */
class Autoload{
    
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
            
            echo("<p>Class : ".$class."</p>");
            
            $class_name = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class_name = str_replace('\\', '/', $class_name);
            $class_name = str_replace('htjan/yaosap/html/cls', '', $class_name);
            
            
            echo("<p>Class Name : ".$class_name."</p>");
            
            
            //         echo ("<p>autoload_function used</p>");
            
            // Directory containing The classes
            $class_dir  = $_SERVER['CONTEXT_DOCUMENT_ROOT']."cls";
            //         echo ("<p>Classes directory : ".$class_dir."</p>");
            // Directories 3-tier hierarchy
            $tier_dirs  = array_diff(scandir($class_dir), array('.', '..'));
            //         echo ("<p> Tiers Directory : </p><p>".print_r($tier_dirs)."</p>");
            //         echo ("<p>Class name : ".$class_name."</p>");
            //         echo ("<p>Class dir : ".class_dir."</p>");
            //         echo ("<p>Tier dir : ".print_r(tier_dirs)."</p>");
            
            //require_once($class_file);
            
            foreach($tier_dirs as $tier_dir)
            {
                
                //             echo "<p>Tier_dir : ".$tier_dir."</p>";
                
                $class_file     = $class_name;
                $class_file     = str_replace('/'.$tier_dir.'/', '', $class_file);
                //$class_file     = $class_file.'.php';
                
                $class_file     = $class_dir."/".$tier_dir."/".$class_file.'.php';
                //$class_file   = $class_name;
                
                             echo ("<p>Class file : ".$class_file."</p>");
                
                
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
            echo "<p>Le fichier contenant la Classe n'est pas accessible</p>";
            return false;
        }
        
        //require_once 'class/' . $class . '.php';
    
    
    }
    
}
