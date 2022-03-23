<?php
use htjan\yaosap\AppConfig;
use Smalot\PdfParser\Parser;

require_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/htjan/yaosap/AppConfig.php');

// Include Composer autoloader if not already done.
include $_SERVER['CONTEXT_DOCUMENT_ROOT'].'/composer/vendor/autoload.php';



// //Parse pdf file and build necessary objects.
// $parser = new Smalot\PdfParser\Parser();
// $pdf    = $parser->parseFile(AppConfig::IMPORT_IN_DIR.'/RLV_CHQ_300040170400000113109_20180820.pdf');
// // $pdf    = $parser->parseFile(AppConfig::IMPORT_IN_DIR.'/file-example_PDF_500_kB.pdf');

$text   = file_get_contents(AppConfig::IMPORT_IN_DIR.'/RLV_CHQ_300040170400000113109_20180820.pdf');

// $text = $pdf->getText();
echo ("<pre>");
echo ($text);
echo ("</pre>");



// // Parse pdf file and build necessary objects.
// $parser = new Smalot\PdfParser\Parser();
// $pdf    = $parser->parseFile(AppConfig::IMPORT_IN_DIR.'/RLV_CHQ_300040170400000113109_20180820.pdf');

// // Retrieve all details from the pdf file.
// $details  = $pdf->getDetails();

// echo ("<pre>");
// // Loop over each property to extract values (string or array).
// foreach ($details as $property => $value) {
//     if (is_array($value)) {
//         $value = implode(', ', $value);
//     }
//     echo $property . ' => ' . $value . "\n";
// }
// echo ("</pre>");
?>