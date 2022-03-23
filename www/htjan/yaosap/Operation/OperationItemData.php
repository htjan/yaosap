<?php
namespace htjan\yaosap\Operation;

class OperationItemData
{
    private $operationId;
    private $categoryId;
    private $subCategoryId;
    private $entityId;
    private $accountId;
    private $paymentMethodId; 	
    private $amount;
    private $label; 	
    private $description; 	
    private $memoLong; 	
    private $createTs; 	
    private $updateTs; 	
    private $active;
    
    
    // TODO - Insert your code here
    public function __construct(
        int $operationId = NULL,
        int $categoryId = NULL,
        int $subCategoryId = NULL,
        int $entityId = NULL,
        int $accountId = NULL,
        int $paymentMethodId = NULL,
        float $amount = NULL,
        string $label = NULL,
        string $description = NULL,
        string $memoLong = NULL,
        int $createTs = NULL,
        int $updateTs = NULL,
        bool $active = NULL)
    {
        
        $this->operationId      = $this->setOperationId($operationId);
        $this->categoryId       = $this->setCategoryId($categoryId);
        $this->subCategoryId    = $this->setSubCategoryId($subCategoryId);
        $this->entityId         = $this->setEntityId($entityId);
        $this->accountId        = $this->setAccountId($accountId);
        $this->paymentMethodId  = $this->setPaymentMethodId($paymentMethodId);
        $this->amount           = $this->setAmount($amount);
        $this->label            = $this->setLabel($label);
        $this->description      = $this->setDescription($description);
        $this->memoLong         = $this->setMemoLong($memoLong);
        $this->createTs         = $this->setCreateTs($createTs);
        $this->updateTs         = $this->setUpdateTs($updateTs);    
        $this->active           = $this->setActive($active);
    }

    
    /**
     * @return mixed
     */
    private function getOperationId()
    {
        return $this->operationId;
    }

    /**
     * @return mixed
     */
    private function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @return mixed
     */
    private function getSubCategoryId()
    {
        return $this->subCategoryId;
    }

    /**
     * @return mixed
     */
    private function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * @return mixed
     */
    private function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @return mixed
     */
    private function getPaymentMethodId()
    {
        return $this->paymentMethodId;
    }

    /**
     * @return mixed
     */
    private function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    private function getLabel()
    {
        return $this->label;
    }

    /**
     * @return mixed
     */
    private function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    private function getMemoLong()
    {
        return $this->memoLong;
    }

    /**
     * @return mixed
     */
    private function getCreateTs()
    {
        return $this->createTs;
    }

    /**
     * @return mixed
     */
    private function getUpdateTs()
    {
        return $this->updateTs;
    }

    /**
     * @return mixed
     */
    private function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $operationId
     */
    private function setOperationId($operationId)
    {
        $this->operationId = $operationId;
    }

    /**
     * @param mixed $categoryId
     */
    private function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @param mixed $subcategoryId
     */
    private function setSubCategoryId($subcategoryId)
    {
        $this->subCategoryId = $subcategoryId;
    }

    /**
     * @param mixed $entityId
     */
    private function setEntityId($entityId)
    {
        $this->entityId = $entityId;
    }

    /**
     * @param mixed $accountId
     */
    private function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * @param mixed $paymentMethodId
     */
    private function setPaymentMethodId($paymentMethodId)
    {
        $this->paymentMethodId = $paymentMethodId;
    }

    /**
     * @param mixed $amount
     */
    private function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @param mixed $label
     */
    private function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @param mixed $description
     */
    private function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $memoLong
     */
    private function setMemoLong($memoLong)
    {
        $this->memoLong = $memoLong;
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
 
}

