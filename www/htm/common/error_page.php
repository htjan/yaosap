<?php
use htjan\yaosap\AppConfig;
use htjan\yaosap\Error\ErrorDisplayer;

require_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/htjan/yaosap/AppConfig.php');
AppConfig::main();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="/css/main.css" type="text/css">
<title>Page d'erreur</title>
<style type="text/css">

</style>
</head>
<body>	

<?php 
// echo ("<PRE>");
// var_dump($_GET);
// echo ("</PRE>");

$error_data = array();


if (AppConfig::ERROR_METHOD == 'GET') {
    $error_data = $_GET;
} elseif (AppConfig::ERROR_METHOD == 'POST') {
    $error_data = $_POST;
} else {
    echo ('<p>Problem</p>');
}

new ErrorDisplayer($error_data);

?>


</body>
</html>
