<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>yaosap</title>
    </head>
<?php

$db_host = "localhost";
$db_name = "yaosap";
$db_user = "yaosap";
#$db_port = "3306";
$db_password = "nc";
#$db_instance = NULL;
$db_pdo = NULL;

$stmt_str_payements="
    SELECT payment.payment_id,
    payment.name payment_name,
    payment.operation_date,
    payment.transaction_date,
    payment_item.payment_item_id,
    payment_item.account_id,
    payment_item.category_id,
    payment_item.entity_id,
    payment_item.payment_method_id,
    payment_item.name payment_item_name,
    payment_item.amount,
    payment_item.description,
    account.name account_name,
    category.name category_name,
    entity.name entity_name,
    payment_method.name payment_method_name
    
FROM 
    payment, payment_item, account, category, entity, payment_method
WHERE 1=1
    AND payment.active=1
    AND payment_item.active=1
    AND payment_item.payment_id=payment.payment_id
    AND account.account_id=payment_item.account_id
    AND category.category_id=payment_item.category_id
    AND entity.entity_id=payment_item.entity_id
    AND payment_method.payment_method_id=payment_item.payment_method_id
    #AND payment.payment_id=540
ORDER BY 
    payment.payment_id,
    payment_item.payment_item_id
";

try {
    $db_pdo = new PDO("mysql:host=".$db_host.";dbname=".$db_name,$db_user,$db_password);

} 
catch (Exception $e) {
    echo "\nPDO::errorInfo():\n";
    print_r($db_pdo->errorInfo());
    echo($e->getMessage());
}

try {
    $stmt_rs_payements = $db_pdo->prepare($stmt_str_payements);  
    $stmt_rs_payements->execute();
    
    #$stmt_nb_payements = $stmt_rs_payements->rowCount();  
    
    $stmt_arr_payements = $stmt_rs_payements->fetchAll();  
    
    if(!$stmt_rs_payements){
        throw new Exception("Requête SQL incorrecte");
    }
//     if(!$stmt_nb_payements){
//         throw new Exception("Impossible de déterminer le nombre d'enregistrements");
//     }
//     if(!$stmt_arr_payements){
//         throw new Exception("Requête SQL impossible à traiter");
//     }
} 
catch (Exception $e) {
    echo "\nPDO::errorInfo():\n";
    print_r($db_pdo->errorInfo());
    exit($e->getMessage());
}

try {
    $stmt_nb_payements = count($stmt_arr_payements);
}
catch (Exception $e) {
    exit($e->getMessage());
}


if($stmt_nb_payements>0){
    
    echo "<table border=\"1\">";

    $buffer_payment_amount=0;
    $buffer_payment_item_lines="";
    
    for($i=0;$i<$stmt_nb_payements;$i++){

        $buffer_payment_amount+=$stmt_arr_payements[$i]['amount'];    

        $buffer_payment_item_lines.="<tr>";
        $buffer_payment_item_lines.="   <td>&nbsp;</td>\n";
        $buffer_payment_item_lines.="   <td>".$stmt_arr_payements[$i]['amount']."</td>\n";
        $buffer_payment_item_lines.="   <td>".$stmt_arr_payements[$i]['payment_item_name']."&nbsp;</td>\n";
        $buffer_payment_item_lines.="   <td>".$stmt_arr_payements[$i]['description']."&nbsp;</td>\n";
        $buffer_payment_item_lines.="   <td>".$stmt_arr_payements[$i]['account_name']."</td>\n";
        $buffer_payment_item_lines.="   <td>".$stmt_arr_payements[$i]['category_name']."</td>\n";
        $buffer_payment_item_lines.="   <td>".$stmt_arr_payements[$i]['entity_name']."</td>\n";
        $buffer_payment_item_lines.="   <td>".$stmt_arr_payements[$i]['payment_method_name']."</td>\n";
        $buffer_payment_item_lines.= "</tr>";
        
        if(!isset($stmt_arr_payements[$i+1]['payment_id']) || $stmt_arr_payements[$i]['payment_id']!=$stmt_arr_payements[$i+1]['payment_id']){
        
            echo ("<tr>");
            echo ("<td>".$stmt_arr_payements[$i]['payment_id']."</td>");
            echo ("<td><b>".$stmt_arr_payements[$i]['payment_name']."</b></td>");
            echo ("<td>".$stmt_arr_payements[$i]['operation_date']."</td>");
            echo ("<td>".$stmt_arr_payements[$i]['transaction_date']."</td>");
            echo ("<td>&nbsp;</td>");
            echo ("<td>&nbsp;</td>");
            echo ("<td>&nbsp;</td>");
            echo ("<td><b>".$buffer_payment_amount."</b></td>");
            echo ("</tr>");
            
            echo ($buffer_payment_item_lines);
            
            /*REINITIALIZING LOOP VARS*/
            $buffer_payment_amount=0;
            $buffer_payment_item_lines="";
            
        }

}

    echo "</table>";
    
} else {
    echo("<p align=\"center\">Aucun résultat</p>");
}

        ?>
    </body>
</html>
