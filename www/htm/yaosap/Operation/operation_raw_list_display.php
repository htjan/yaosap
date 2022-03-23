<?php
use htjan\yaosap\Operation\OperationRawListDisplay;
use htjan\yaosap\AppConfig;

/* Affichage liste et pager raw import */
if (! isset($_REQUEST['curPage'])) 
{
    $current_page = 0;
} 
else 
{
    $current_page = $_REQUEST['curPage'];
}

if (! isset($_REQUEST['maxItems'])) 
{
    $maxItem = AppConfig::MAX_ITEM_PER_PAGE;
} 
else
{
    $maxItem = $_REQUEST['maxItems'];
}

if (! isset($_REQUEST['order'])) 
{
    $order = 'id_ASC';
} 
else 
{
    $order = $_REQUEST['order'];
}

if (! isset($_REQUEST['maxPages'])) 
{
    $maxPages = 5;
} 
else 
{
    $maxPages = $_REQUEST['maxPages'];
}

$operationObj = new OperationRawListDisplay($order);
$operationTableHtml = $operationObj->getTableHtmlContent($current_page, $maxItem);

echo ($operationTableHtml);

$operationPagerHtml = $operationObj->getPagerHtmlContent($current_page, $maxItem, $maxPages, $order);

echo ($operationPagerHtml);

?>