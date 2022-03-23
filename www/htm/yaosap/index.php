<?php
use htjan\yaosap\AppConfig;
use htjan\yaosap\WebUserInterface\WebPage;

/*App Config*/
require_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/htjan/yaosap/AppConfig.php');

/*Error reporting*/
error_reporting(E_ALL);
ini_set('display_errors', '1');

/*session start*/
session_start();

/*Database connection*/
$dbh = new \PDO('mysql:host='.AppConfig::DATABASE_HOST.';dbname='.AppConfig::DATABASE_NAME, AppConfig::DATABASE_USER, AppConfig::DATABASE_PASSWORD);

/*Register autoload and error manager */
if(!AppConfig::main()) {
    echo("<p>Can't set up Application configuration</p>");
}

?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/css/main.css"/> 
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title></title>
</head>
<body>

<div align="center">
<b>Menu :</b>
<?php 
/* Menu */
foreach (AppConfig::WEB_PAGE as $key => $value){
    echo ('<a href=\'index.php?page_name='.$key.'\'>'.$key.'</a> ');
}
?>
<p>&nbsp;</p>
</div>
<hr>
<p>&nbsp;</p>


<?php 

/*Display web page*/
if(!isset($_REQUEST['page_name']) || is_null($_REQUEST['page_name']) || $_REQUEST['page_name']== ''){
    $page_name = 'default';
} else {
    $page_name = $_REQUEST['page_name'];
}
$web_page = new WebPage($page_name);


/*Debug*/
echo("<hr>");
echo("<pre>");
echo('page_name : '.$page_name.chr(10).chr(13));
print_r($web_page);
echo(chr(10).chr(13));
echo("</pre>");

?>

</body>
</html>

