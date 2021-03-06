<?php
use htjan\yaosap\AppConfig;

require_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/htjan/yaosap/AppConfig.php');
AppConfig::main();

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
            echo("<hr><h1>Text section</h1><p>".$textsection."</p><p>&nbsp;</p>");
            $data = @gzuncompress($textsection);
            echo("<hr><h1>Data</h1><p>".$data."</p><p>&nbsp;</p>");
            
            $pdfText .= pdfExtractText($data);
            $startpos = $pos2 + strlen($searchend) - 1;
        }
    }
    return preg_replace('/(\\s)+/', ' ', $pdfText);
} 

function pdfExtractText($psData){
    
    if (!is_string($psData)) {
        return '';
    }
    
    $text = '';
    
    // Handle brackets in the text stream that could be mistaken for
    // the end of a text field. I'm sure you can do this as part of the
    // regular expression, but my skills aren't good enough yet.
    $psData = str_replace('\\)', '##ENDBRACKET##', $psData);
    $psData = str_replace('\\]', '##ENDSBRACKET##', $psData);
    
    preg_match_all(
        '/(T[wdcm*])[\\s]*(\\[([^\\]]*)\\]|\\(([^\\)]*)\\))[\\s]*Tj/si',
        $psData,
        $matches
        );
    
    echo("<pre>Matches : ".count($matches)."</pre>");
    
    for ($i = 0; $i < sizeof($matches[0]); $i++) {
        if ($matches[3][$i] != '') {
            // Run another match over the contents.
            preg_match_all('/\\(([^)]*)\\)/si', $matches[3][$i], $subMatches);
            foreach ($subMatches[1] as $subMatch) {
                $text .= $subMatch;
            }
        } else if ($matches[4][$i] != '') {
            $text .= ($matches[1][$i] == 'Tc' ? ' ' : '') . $matches[4][$i];
        }
    }
    
    // Translate special characters and put back brackets.
    $trans = array(
        '...'                => '&#8230;',
        '\\205'                => '&#8230;',
        '\\221'                => chr(145),
        '\\222'                => chr(146),
        '\\223'                => chr(147),
        '\\224'                => chr(148),
        '\\226'                => '-',
        '\\267'                => '&#8226;',
        '\\('                => '(',
        '\\['                => '[',
        '##ENDBRACKET##'    => ')',
        '##ENDSBRACKET##'    => ']',
        chr(133)            => '-',
        chr(141)            => chr(147),
        chr(142)            => chr(148),
        chr(143)            => chr(145),
        chr(144)            => chr(146),
    );
    $text = strtr($text, $trans);
    
    return $text;
    
}
$get = pdf2string(AppConfig::IMPORT_IN_DIR.'/file-example_PDF_500_kB.pdf');
//echo $get;

