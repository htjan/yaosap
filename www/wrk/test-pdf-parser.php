<?php 
require_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/php-pdf-parser/pdf.php');
require_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/htjan/yaosap/AppConfig.php');
AppConfig::main();

$pdf = new PdfFileReader(fopen(AppConfig::IMPORT_IN_DIR.'/RLV_CHQ_300040170400000113109_20180820.pdf', 'rb'));
var_dump( $pdf );

?>
