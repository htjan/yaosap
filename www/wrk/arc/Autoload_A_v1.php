<?php

namespace htjan\yaosap\cls\ctl;

class Autoload {
    
    public function autoload_function($class_name)
    {   
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
            
            $class_file   = $class_dir."/".$tier_dir."/".$class_name.'.php';
            //$class_file   = $class_name;
            
//             echo ("<p>Class file : ".$class_file."</p>");
            
            if(file_exists($class_file))
            {
                require_once("/var/www/html/yaosap.net/html/cls/mdl/AppConfig.php");
                echo "<p>Fichier inclus : ".$class_file."</p>";
                
                return true;
                if (require_once($class_file))
                {
                    //$use_namespace  = "htjan\\yaosap\\cls\\".$tier_dir."\\".$classname;
//                     $use_namespace  = "htjan\yaosap\cls\mdl\AppConfig";
//                     use $use_namespace
//                  
                    //use "htjan\yaosap\cls\mdl\AppConfig";
                    
                    //only require the class once, so quit after to save effort (if you got more, then name them something else
//                     echo "<p>Classe appellée : ".$class_file."</p>";
                    //echo "<p>Fichier inclus : ".$class_file."</p>";

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
    
}

?>