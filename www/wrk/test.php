<?php
use htjan\yaosap\AppConfig;
use htjan\yaosap\WebUserInterface\WebPage;

/*App Config*/
require_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/htjan/yaosap/AppConfig.php');

/*Database connection*/
$dbh = new \PDO('mysql:host='.AppConfig::DATABASE_HOST.';dbname='.AppConfig::DATABASE_NAME, AppConfig::DATABASE_USER, AppConfig::DATABASE_PASSWORD);

/*Error reporting*/
error_reporting(E_ALL);
ini_set('display_errors', '1');

/*session start*/
session_start();

/*Register autoload and error manager */
if(!AppConfig::main()) {
    echo("<p>Can't set up Application configuration</p>");
}

?>
<p>page test</p>

<?php 

$operationRawList = new OperationRawListDisplay();
echo($operationRawList->displayContent());
?>
