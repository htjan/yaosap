<?php
namespace htjan\yaosap\Operation;

use Exception;
use htjan\yaosap\AppConfig;
use htjan\yaosap\DataSource\PDOSingleton;

class OperationRawItemData
{
    public $id;
    public $dateOpe;  
    public $typeOpe;   
    public $typeOpeShort;     
    public $label;
    public $amount;
    public $category;
    public $subCategory;
    public $comments;
 
    // TODO - Insert your code here
    public function __construct(string $dateOpe, string $typeOpe, string $typeOpeShort, string $label, string $amount, string $category, string $subCategory, string $comments, int $id = NULL)
    {
        // TODO - Insert your code here
        if(isset($id))
        {
            $this->setId($id);
        }
        $this->setDateOpe($dateOpe);
        $this->setTypeOpe($typeOpe);
        $this->setTypeOpeShort($typeOpeShort);
        $this->setLabel($label);
        $this->setAmount($amount);
        $this->setCategory($category);
        $this->setSubCategory($subCategory);
        $this->setComments($comments);
    }
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDateOpe()
    {
        return $this->dateOpe;
    }

    /**
     * @return mixed
     */
    public function getTypeOpe()
    {
        return $this->typeOpe;
    }

    /**
     * @return mixed
     */
    public function getTypeOpeShort()
    {
        return $this->typeOpeShort;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getSubCategory()
    {
        return $this->subCategory;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $id
     */
    private function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $dateOpe
     */
    private function setDateOpe($dateOpe)
    {
        $this->dateOpe = $dateOpe;
    }

    /**
     * @param mixed $typeOpe
     */
    private function setTypeOpe($typeOpe)
    {
        $this->typeOpe = $typeOpe;
    }

    /**
     * @param mixed $typeOpeShort
     */
    private function setTypeOpeShort($typeOpeShort)
    {
        $this->typeOpeShort = $typeOpeShort;
    }

    /**
     * @param mixed $label
     */
    private function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @param mixed $amount
     */
    private function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @param mixed $category
     */
    private function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @param mixed $subCategory
     */
    private function setSubCategory($subCategory)
    {
        $this->subCategory = $subCategory;
    }

    /**
     * @param mixed $comments
     */
    private function setComments($comments)
    {
        $this->comments = $comments;
    }


    public function createItem(){
        $query  = '
INSERT INTO import_operation_raw
(dateOpe,  typeOpe,   typeOpeShort,     label,  amount,     category,   subCategory,    comments)
VALUES
(:dateOpe, :typeOpe,  :typeOpeShort,    :label, :amount,    :category,  :subCategory,   :comments)';
   
        try
        {
        
            $dbh = PDOSingleton::getInstance();
            $stmt = $dbh->prepare($query);
            $stmt->bindValue('dateOpe', $this->getDateOpe(), \PDO::PARAM_STR);
            $stmt->bindValue('typeOpe', $this->getTypeOpe(), \PDO::PARAM_STR);
            $stmt->bindValue('typeOpeShort', $this->getTypeOpeShort(), \PDO::PARAM_STR);
            $stmt->bindValue('label', $this->getLabel(), \PDO::PARAM_STR);
            $stmt->bindValue('amount', $this->getAmount(), \PDO::PARAM_STR);
            $stmt->bindValue('category', $this->getCategory(), \PDO::PARAM_STR);
            $stmt->bindValue('subCategory', $this->getSubCategory(), \PDO::PARAM_STR);
            $stmt->bindValue('comments', $this->getComments(), \PDO::PARAM_STR);
            $stmt->execute();
            
            $lastInsertId = $dbh->lastInsertId();
            $this->setId($lastInsertId);
            if(!$stmt)
            {
                echo("<p>".AppConfig::ERROR_MESSAGE[30]."</p>");
                return false;
            }
            if(!$lastInsertId)
            {
                echo("<p>".AppConfig::ERROR_MESSAGE[33]."</p>");
                return false;
            }
        }
        catch (Exception $e) 
        {
            echo("<p>".AppConfig::ERROR_MESSAGE[30]."</p>");    
        }
    }

    function readItem()
    {
        $query  = 'SELECT dateOpe, typeOpe, typeOpeShort, label, amount, category, subCategory, comments FROM import_operation_raw WHERE id=:id';
        
        try
        {
            $dbh = PDOSingleton::getInstance();
            $stmt   = $dbh->prepare($query);
            $stmt->bindValue('id', $this->getId(), \PDO::PARAM_INT);
            $stmt->execute();
            $operation = $stmt->fetchAll();
                        
            $this->setDateOpe($operation[0]['dateOpe']);
            $this->setTypeOpe($operation[0]['typeOpe']);
            $this->setTypeOpeShort($operation[0]['typeOpeShort']);
            $this->setLabel($operation[0]['label']);
            $this->setAmount($operation[0]['amount']);
            $this->setCategory($operation[0]['category']);
            $this->setSubCategory($operation[0]['subCategory']);
            $this->setComments($operation[0]['comments']);
            
            return true;
        }
        catch (Exception $e)
        {
            echo("<p>".AppConfig::ERROR_MESSAGE[31]."</p>");
        }
    }
    
    function updateItem(){
        $query  = '
UPDATE import_operation_raw
SET 
    dateOpe     = :dateOpe,  
    typeOpe     = :typeOpe,   
    typeOpeShort= :typeOpeShort,     
    label       = :label,  
    amount      = :amount,     
    category    = :category,   
    subCategory = :subCategory,   
    comments    = :comments
WHERE id = :id';
        
        try
        {
            $dbh = PDOSingleton::getInstance();
            $stmt   = $dbh->prepare($query);
            $stmt->bindValue('id', $this->getId(), \PDO::PARAM_INT);
            $stmt->bindValue('dateOpe', $this->getDateOpe(), \PDO::PARAM_STR);
            $stmt->bindValue('typeOpe', $this->getTypeOpe(), \PDO::PARAM_STR);
            $stmt->bindValue('typeOpeShort', $this->getTypeOpeShort(), \PDO::PARAM_STR);
            $stmt->bindValue('label', $this->getLabel(), \PDO::PARAM_STR);
            $stmt->bindValue('amount', $this->getAmount(), \PDO::PARAM_STR);
            $stmt->bindValue('category', $this->getCategory(), \PDO::PARAM_STR);
            $stmt->bindValue('subCategory', $this->getSubCategory(), \PDO::PARAM_STR);
            $stmt->bindValue('comments', $this->getComments(), \PDO::PARAM_STR);
            $stmt->execute();
            
            return true;
        }
        catch (Exception $e)
        {
            echo("<p>".AppConfig::ERROR_MESSAGE[32]."</p>");
        }
    }
    
    public function checkIfExists()
    {
        $query  = '
SELECT id FROM import_operation_raw
WHERE dateOpe   = :dateOpe
AND label       = :label
AND amount      = :amount
';
        try
        {
            $dbh    = PDOSingleton::getInstance();
            $stmt   = $dbh->prepare($query);
            $stmt   = $dbh->prepare($query);
            $stmt->bindValue('dateOpe', $this->getDateOpe(), \PDO::PARAM_STR);
            $stmt->bindValue('label', $this->getLabel(), \PDO::PARAM_STR);
            $stmt->bindValue('amount', $this->getAmount(), \PDO::PARAM_STR);
            $stmt->execute();
            
            $operation = $stmt->fetchAll();
            
            if(count($operation) > 0)
            {
                $this->setId($operation[0]['id']);
                return true; 
            }
            else 
            {
                return false;
            }
        }
        catch (Exception $e)
        {
            echo("<p>".AppConfig::ERROR_MESSAGE[32]."</p>");
        }
        
    }
}

