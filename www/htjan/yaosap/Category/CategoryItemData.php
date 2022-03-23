<?php
namespace htjan\yaosap\Category;

use Exception;
use htjan\yaosap\AppConfig;
use htjan\yaosap\DataSource\PDOSingleton;

class CategoryItemData
{

    private $categoryId;
    private $name;
    private $createTs;
    private $updateTs; 
    private $active; 

    // TODO - Insert your code here
    public function __construct($categoryId = NULL, $name = NULL, $active = NULL)
    {
        $this->setCategoryId($categoryId);
        $this->setName($name);
        // TODO - Insert your code here
    }
    
    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getCreateTs()
    {
        return $this->createTs;
    }

    /**
     * @return mixed
     */
    public function getUpdateTs()
    {
        return $this->updateTs;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $categoryId
     */
    private function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @param mixed $name
     */
    private function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $createTs
     */
    private function setCreateTs($createTs)
    {
        $this->createTs = $createTs;
    }

    /**
     * @param mixed $updateTs
     */
    private function setUpdateTs($updateTs)
    {
        $this->updateTs = $updateTs;
    }

    /**
     * @param mixed $active
     */
    private function setActive($active)
    {
        $this->active = $active;
    }
  
    public function createItem()
    {
        $query='
INSERT INTO 
category 
(categoryId, name, createTs, updateTs, active) 
VALUES 
(NULL, :name, :createTs, NULL, :active) 
';
            try
            {
                
                $dbh = PDOSingleton::getInstance();
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(':name', $this->name, \PDO::PARAM_STR);
                $stmt->bindParam(':createTs', time(), \PDO::PARAM_STR);
                $stmt->bindParam(':active', $this->active, \PDO::PARAM_STR);
                $stmt->execute();
            }
            catch (\Exception $e)
            {
                echo("<p>".AppConfig::ERROR_MESSAGE[30]."</p>");
            }
            
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
    
    function readItem()
    {
        $query  = 'SELECT categoryId, name, createTs, updateTs, active FROM category WHERE categoryId=:categoryId';
        
        try
        {
            $dbh = PDOSingleton::getInstance();
            $stmt   = $dbh->prepare($query);
            $stmt->bindValue('categoryId', $this->getCategoryId(), \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll();
                        
            $this->setName($result[0]['name']);
            $this->setCreateTs($result[0]['createTs']);
            $this->setUpdateTs($result[0]['updateTs']);
            $this->setActive($result[0]['active']);
            
            return true;
        }
        catch (Exception $e)
        {
            echo("<p>".AppConfig::ERROR_MESSAGE[31]."</p>");
        }
    }
    
    function updateItem(){
        $query  = '
UPDATE category
SET
    name=:name, 
    updateTs=:updateTs, 
    active=:active
WHERE 
    categoryId=:categoryId 
    ';
        
        try
        {
            $dbh = PDOSingleton::getInstance();
            $stmt   = $dbh->prepare($query);
            $stmt->bindValue('name', $this->getName(), \PDO::PARAM_INT);
            $stmt->bindValue('updateTs', time(), \PDO::PARAM_INT);
            $stmt->bindValue('active', $this->getActive(), \PDO::PARAM_INT);
            $stmt->execute();
            
            return true;
        }
        catch (Exception $e)
        {
            echo("<p>".AppConfig::ERROR_MESSAGE[32]."</p>");
        }
        
        
    }
    
}

