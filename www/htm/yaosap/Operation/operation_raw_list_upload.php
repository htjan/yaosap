<?php 
use htjan\yaosap\Operation\OperationRawItemData;

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'operation_raw_list_upload')
{

    $isValidFile = true;
    $fileName = $_FILES["upload_file"]["name"];
    $fileTmpName = $_FILES["upload_file"]["tmp_name"];
    
    if($fileName == '')
    {
        echo('<p>No file uploaded</p>');    
        $isValidFile = false;
    }
    
    // Validate file extension
    $allowedFileType = array(
        'csv',
        'txt'
    );
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (! in_array($fileExtension, $allowedFileType) && $isValidFile == true) 
    {
        echo "<span>File is not supported. Upload only <b>" . implode(", ", $allowedFileType) . "</b> files.</span>";
        $isValidFile = false;
    }
    
    // Validate file size
    if ($_FILES["upload_file"]["size"] > 200000 && $isValidFile == true) 
    {
        echo "<span>File is too large to upload.</span>";
        $isValidFile = false;
    }
    
    if($isValidFile == true)
    {
        $file = fopen($fileTmpName, "r");
        $i = 0;
        $count_update = 0;
        $count_insert = 0;
        $operationRawList = array();
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) 
        {
            $operationRawList[$i]['dateOpe']       = $column[0];
            $operationRawList[$i]['typeOpe']       = $column[1];
            $operationRawList[$i]['typeOpeShort']  = $column[2];
            $operationRawList[$i]['label']         = $column[3];
            $operationRawList[$i]['amount']        = $column[4];
            $operationRawList[$i]['category']      = $column[5];
            $operationRawList[$i]['subCategory']   = $column[6];
            $operationRawList[$i]['comments']      = $column[7];
            
            $operationRawItem   = new OperationRawItemData(
                $operationRawList[$i]['dateOpe'], 
                $operationRawList[$i]['typeOpe'],
                $operationRawList[$i]['typeOpeShort'],
                $operationRawList[$i]['label'],
                $operationRawList[$i]['amount'],
                $operationRawList[$i]['category'],
                $operationRawList[$i]['subCategory'],
                $operationRawList[$i]['comments']
            );

            if($operationRawItem->checkIfExists())
            {
                $operationRawItem->updateItem();
                $count_update++;
                echo("<p>Enregistrement existant - Mise à jour id #".$operationRawItem->getId()."</p>");
            }
            else
            {
                $operationRawItem->createItem();
                $count_insert++;
                echo("<p>Enregistrement inexistant - Création id #".$operationRawItem->getId()."</p>");
            }
            
            
            $i++;
        }
        echo("<p>File Uploaded</p>");
        echo("<p>".$i." records processed</p>");
        echo("<p>".$count_update." records updated</p>");
        echo("<p>".$count_insert." records inserted</p>");
    }  
} 
?>


<p>transactions_upload.php</p>

<div class="row">
    <form name="from_file_upload" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="operation_raw_list_upload">
    	<div class="input-row">
    		<input type="file" name="upload_file" accept=".csv">
    	</div>
    	<input type="submit" name="upload" value="Upload File">
    </form>
</div>