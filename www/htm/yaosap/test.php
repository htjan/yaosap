<?php
use htjan\yaosap\AppConfig;
use htjan\yaosap\Category\CategoryItemData;

/* Valeur timestamp */
// $current_timestamp = time();
// echo $current_timestamp;
// exit;

$categoryObj = new CategoryItemData(1);
$categoryObj->readItem();

$categoryId     = $categoryObj->getCategoryId();
$categoryName   = $categoryObj->getName();
$categoryCreateTs   = $categoryObj->getCreateTs();
$categoryUpdateTs   = $categoryObj->getUpdateTs();
$categoryActive     = $categoryObj->getActive();


echo ($categoryId." ".$categoryName." ".$categoryCreateTs." ".$categoryUpdateTs." ".$categoryActive);