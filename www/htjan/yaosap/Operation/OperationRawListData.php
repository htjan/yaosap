<?php
namespace htjan\yaosap\Operation;

use Exception;
use htjan\yaosap\AppConfig;
use htjan\yaosap\Operation\OperationRawItemData;
use htjan\yaosap\DataSource\PDOSingleton;

class OperationRawListData
{
    public $idList = array();
    public $operationList = array();
    
    
    // TODO - Insert your code here
    public function __construct($order = NULL)
    {
        $this->setIdList($order);
        $this->setOperationList();
        // TODO - Insert your code here
    }
    
    /**
     * @return array
     */
    public function getIdList()
    {
        return $this->idList;
    }
    
    /**
     * @return array
     */
    public function getOperationList()
    {
        return $this->operationList;
    }

    
    public function setIdList($order = NULL)
    {
        $query  = 'SELECT id FROM import_operation_raw';
        
        if(!is_null($order))
        {
            $orderArr  = explode('_',$order);
            $column     = $orderArr[0];
            $type       = $orderArr[1];
        }
        else
        {
            $column     = 'id';
            $type       = 'ASC';
        }
        
        $orderString    = ' ORDER BY ';
        
        switch ($column) {
            case 'id':
                $orderString .=' id ';
                break;
            case 'dateOpe':
                $orderString .=' dateOpe ';
                break;
            case 'typeOpe':
                $orderString .=' typeOpe ';
                break;
            case 'typeOpeShort':
                $orderString .=' typeOpeShort ';
                break;
            case 'label':
                $orderString .=' label ';
                break;
            case 'amount':
                $orderString .=' amount ';
                break;
            case 'category':
                $orderString .=' category ';
                break;
            case 'subCategory':
                $orderString .=' subCategory ';
                break;
            case 'comments':
                $orderString .=' comments ';
                break;
            default:
                $orderString .=' id ';
        }
        
        switch ($type) {
            case 'ASC':
                $orderString .=' ASC ';
                break;
            case 'DESC':
                $orderString .=' DESC ';
                break;
            default:
                $orderString .=' ASC ';
        }
        
        $query .= $orderString;
        
        try
        {
            $dbh        = PDOSingleton::getInstance();
            $stmt       = $dbh->prepare($query);
            $stmt->execute();
            $ids        = $stmt->fetchAll();
            
            for($i=0 ; $i < count($ids); $i++)
            {
                $this->idList[$i] =$ids[$i][0];
            }
            return true;
        }
        catch (Exception $e)
        {
            echo("<p>".AppConfig::ERROR_MESSAGE[40]."</p>");
        }
    }
    
    /**
     * @param mixed $operationList
     */
    private function setOperationList()
    {
        try
        {   
            for($i=0 ; $i < count($this->idList); $i++)
                {
                 $this->operationList[$i] = new OperationRawItemData('', '', '', '', '', '', '', '', $this->idList[$i]);
                 $this->operationList[$i]->readItem();
                    
            }
            return true;
        }
        catch (Exception $e)
        {
            echo("<p>".AppConfig::ERROR_MESSAGE[40]."</p>");
        }
    }
}

