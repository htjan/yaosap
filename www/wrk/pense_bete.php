<?php 


echo('<pre>');
print_r($app_config_obj);
echo('</pre>');


// Generic getter for class attributes
function getAppValue($key){
    if(array_key_exists($key,$this->var)) {
        return $this->var[$key];
    }
    else {
        return "Undefined";
    }
}



// File: list.php
// Afficher la liste des répertoires et fichiers présents dans un répertoire.
$output = "";
exec("ls -al",$output);
foreach($output as $line) {
    echo $line . "<br>\n";
}


// Get string between two strings
function getBetween($content,$start,$end){
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
}

// Get string between two strings
// https://stackoverflow.com/a/9826656
function get_string_between($string, $start, $end)
{
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0)
        return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
}


// Extraire des données compressées d'un pdf.
// https://www.vvzixun.com/code/2dda96c33e90ad9dd1119ba3216bad62
// 
header('Content-Type: text');           // I going to download the result of decoding
$n = "binary_file.bin";                 // decoded part in file in a directory
$f = @fopen($n, "rb");                  // now file is mine
$c = fread($f, filesize($n));           // now I know all about it 
$u = @gzuncompress($c);                 // function, exactly fits for this /FlateDecode filter
$out = fopen("php://output", "wb");     // ready to output anywhere
fwrite($out, $u);                       // output to downloadable file


// Extracting text from pdf 
// https://www.sitepoint.com/community/t/extracting-text-from-pdf/1271/2
// silentcollision

function pdf2string($sourcefile) {
    /*
     $fp = fopen($sourcefile, 'rb');
     $content = fread($fp, filesize($sourcefile));
     fclose($fp);
     */
    $content = file_get_contents($sourcefile);
    $searchstart = 'stream';
    $searchend = 'endstream';
    $pdfText = '';
    $pos = 0;
    $pos2 = 0;
    $startpos = 0;
    while ($pos !== false && $pos2 !== false) {
        $pos = strpos($content, $searchstart, $startpos);
        $pos2 = strpos($content, $searchend, $startpos + 1);
        if ($pos !== false && $pos2 !== false){
            if ($content[$pos] == 0x0d && $content[$pos + 1] == 0x0a) {
                $pos += 2;
            } else if ($content[$pos] == 0x0a) {
                $pos++;
            }
            if ($content[$pos2 - 2] == 0x0d && $content[$pos2 - 1] == 0x0a) {
                $pos2 -= 2;
            } else if ($content[$pos2 - 1] == 0x0a) {
                
                $pos2--;
            }
            $textsection = substr(
                $content,
                $pos + strlen($searchstart) + 2,
                $pos2 - $pos - strlen($searchstart) - 1
                );
            $data = @gzuncompress($textsection);
            $pdfText .= pdfExtractText($data);
            $startpos = $pos2 + strlen($searchend) - 1;
        }
    }
    return preg_replace('/(\\s)+/', ' ', $pdfText);
} 

if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //Valid email!
}




// Propriété "class" d'une classe.
/*
namespace foo {
    class bar {
    }
    
    echo bar::class; // foo\bar
}
*/
// Manipumler les constantes
class test0 {

    const ONE = 1;
    
    class foo {
        // Depuis PHP 5.6.0
        const TWO = ONE * 2;
        const THREE = ONE + self::TWO;
        const SENTENCE = 'The value of THREE is '.self::THREE;
    }
    
    echo ('<pre>');
    echo (foo::TWO);
    echo (foo::THREE);
    echo (foo::SENTENCE);
    
    echo ('</pre>');

}


?>