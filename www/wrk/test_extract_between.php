<?php

use 		htjan\yaosap\AppConfig as AppConfig;

require_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/htjan/yaosap/AppConfig.php');
AppConfig::main();

restore_error_handler ( ) ;

// Parse pdf file and stock content in a variable $pdf_content.
$pdf_content            = file_get_contents(AppConfig::IMPORT_IN_DIR.'/RLV_CHQ_300040170400000113109_20180820.pdf');

/*Extract compressed data*/
$sub_str                = array();

$data                   = preg_replace('/\t/', ' ', $pdf_content);
$data_len               = strlen($pdf_content);

$ini_word               = chr(13).'stream'.chr(10);
$end_word               = chr(10).'endstream'.chr(10);

$ini_pos                = 1;
$end_pos                = 0;
$offset                 = 0;

$i_max                  = 10;

$i = 0;
echo("<pre>");

/*
//463 occurences trouvées
while ($ini_pos < $data_len && $end_pos < $data_len && $i<$i_max){
    
    //substr ( string $string , int $offset [, int|null $length = null ] ) : string
    //$current_content        = substr($pdf_content, $current_offset_position);
    
    //strpos ( string $haystack , string $needle [, int $offset = 0 ] )
    $ini_pos            = strpos($data, $ini_word, $offset) + strlen($ini_word);
    $end_pos            = strpos($data, $end_word, $ini_pos) - strlen($end_word);

    if ( $ini_pos <= 0 || $end_pos <= 0 ) {
        // Error : no iniword or endword
        if ( $i <= 0 ) {
            echo ("<pre>Pas de correspondance trouvée.</pre>");
        }
        else {
            echo ("<pre>Toutes les correspondances ont été trouvées: ".($i+1)." occurences</pre>");
        }
        break;
    }
       
    if ($ini_pos > $end_pos){
        echo ("<pre>Erreur : du mot de début est situé après le mot de fin. ini_pos = $ini_pos | end_pos = $end_pos</pre>");   
        break;
    }
        
    $sub_len            = $end_pos - $ini_pos;
    
    $sub_str[$i]["ini"] = $ini_pos;
    $sub_str[$i]["sub"] = trim(substr($data, $ini_pos, $sub_len));
    
    $offset             = $end_pos+strlen($end_word)+1;
 
    echo ("<pre>");
    echo ("ini_pos = $ini_pos\n");
    echo ("end_pos = $end_pos\n");
    echo ("sub_len = $sub_len\n");
    echo ("sub_str = ".$sub_str[$i]["sub"]."\n");
    echo ("Compressed data = ".gzuncompress($sub_str[$i]["sub"]));
    echo ("</pre>");
    $i++;

}
*/
//print_r($sub_str);

$ini_sub            = explode($ini_word, $data);


echo("\nCount ini_sub : ".count($ini_sub)."\n");


$i=0;

if ( ! $ini_sub ) {
    echo("No initial word found");
    exit;
}

for ($i=0; $i<count($ini_sub); $i++ ) {
    $end_sub    = explode($end_word, $ini_sub[$i]);
    $stream     = trim($end_sub[0], "\x00..\x1F");
    $sub[$i]  = $stream;
    echo("\n end_sub $i : ");
    //var_dump($stream);
    echo("\nSub $i uncompressed:\n ".gzuncompress($sub[$i])."\n");
    $i++;
}

if ( ! $sub ) {
    echo("No final word found");
    exit;
}


// echo("\nSub : ".count($sub)."\n");
// for ($i=0; $i<4; $i++ ) {
//     echo("\nSub $i :\n ".$sub[$i]."\n");
//     echo("\nSub $i uncompressed:\n ".gzuncompress($sub[$i])."\n");
// }


// for ($i=0; $i<count($ini_sub); $i++) {
//     echo ("<p>Data[$i]</p>");
//     echo (print_r($ini_sub[$i]));
//     echo ("<hr>");
// }


echo("</pre>");

//echo ("<pre>$data</pre>");

