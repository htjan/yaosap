<?php
use htjan\yaosap\AppConfig;
use htjan\yaosap\Transaction\TransactionItem;

require_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/htjan/yaosap/AppConfig.php');
AppConfig::main();
    
$trans              = new TransactionItem();

echo ("<p>Test static : ".AppConfig::APP_NAMESPACES[0]['name']."</p>");
echo ("<p>Test AppConfig : ".$trans->transaction_item_id."</p>");

?>