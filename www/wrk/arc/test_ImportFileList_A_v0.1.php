<?php 

namespace htjan\yaosap;

require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'].'cls/utl/AppConfig.php');
require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'].'cls/utl/ErrorHandler.php');
require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'].'cls/mdl/FileImportList.php');

use htjan\yaosap\cls\mdl\FileImportList;
use htjan\yaosap\cls\utl\ErrorHandler;
use htjan\yaosap\cls\utl\AppConfig;

/**/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Test</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link type="image/x-icon" rel="icon" href="/favicon.ico" />
	<link type="text/css" rel="stylesheet" href="/css/main.css" />
	
</head>
<body>
<?php


$fil        = new FileImportList();
$file_arr   = $fil->listFiles();

if ($file_arr != false) {

    for ($i=0; $i<sizeof($file_arr); $i++) 
    {
        echo ($file_arr[$i]->getFileName());
        echo("</br>");
        //echo("Indice : ".$key." File : ".$file);
    }
}
else 
{
    $error_handler = new ErrorHandler(ErrorHandler::YOASAA_ERR_CLS_FILEIMPORTLIST_0,__FILE__,__CLASS__);
    $error_handler->getErrorPage();
}
    
    
?>
</body>
</html>