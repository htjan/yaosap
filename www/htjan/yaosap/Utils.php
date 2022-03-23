<?php
namespace htjan\yaosap\utl;

class MonthCalendar {
    
    public static $mo_arr = array (
        1 	=> 'janvier',
        2 	=> 'février',
        3 	=> 'mars',
        4 	=> 'avril',
        5 	=> 'mai',
        6 	=> 'juin',
        7 	=> 'juillet',
        8 	=> 'août',
        9 	=> 'septembre',
        10 	=> 'octobre',
        11 	=> 'novembre',
        12 	=> 'décembre'
    );
    
	
	public function getLabelList () {
	    return self::$mo_arr;
	}
	
	
	public function getLabelFromNum ($num) {
	    return self::$mo_arr[$num];
	}
	
	public function getNumFromLabel ($label) {
	    foreach ( self::$mo_arr as $k => $val ) {
			if ( $val == $label ) {
				return $k;
			}
		}
		
		
	}
	
}

class CSVSeparator {
    
    public static $separator_array = array (
        ",",
        ";",
        "|",
        "~"        
    );
           
    public function getSeparatorRegEx() {
        return implode("|",self::$separator_array);              
        
    }
    
}



?>
