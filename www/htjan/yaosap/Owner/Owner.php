<?php
namespace htjan\yaosap\Owner;

use htjan\yaosap\ErrorManager;
use htjan\yaosap\AppConfig;

require_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'] . 'cls/mdl/AppConfig.php');
/**
 *
 * @author ncflm
 *        
 */
class Owner
{

    // TODO - Insert your code here

    /**
     */

    private int     $_owner_id;
    private string  $_firstname;
    private string  $_lastname;
    private string  $_email;
    private string  $_superuser;
    private int     $_create_ts;
    private int     $_update_ts;
    private int     $_active;
    
    /**
     * @return mixed
     */
    public function getOwner_id()
    {
        return $this->_owner_id;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->_firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->_lastname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @return mixed
     */
    public function getSuperuser()
    {
        return $this->_superuser;
    }

    /**
     * @return mixed
     */
    public function getCreate_ts()
    {
        return $this->_create_ts;
    }

    /**
     * @return mixed
     */
    public function getUpdate_ts()
    {
        return $this->_update_ts;
    }

    /**
     * @return mixed
     */
    public function isActive()
    {
        return $this->_active;
    }

    /**
     * @param mixed $_owner_id
     */
    public function setOwner_id($_owner_id)
    {
        if(is_integer($_owner_id) && $_owner_id>=0) {
            $this->_owner_id = $_owner_id;
            return true;
        } else {
            ErrorManager::getError(AppConfig::ERROR_MESSAGE[1], __FILE__, __LINE__, __CLASS__, __METHOD__);
            return false;
        }
    }

    /**
     * @param mixed $_firstname
     */
    public function setFirstname($_firstname)
    {
        if(is_string($_firstname) && $_firstname!='') {
            $this->_firstname = $_firstname;
            return true;
        } else {
            ErrorManager::getError(AppConfig::ERROR_MESSAGE[3], __FILE__, __LINE__, __CLASS__, __METHOD__);
            return false;
        }
    }

    /**
     * @param mixed $_lastname
     */
    public function setLastname($_lastname)
    {
        if(is_string($_lastname) && $_lastname!='') {
            $this->_lastname = $_lastname;
            return true;
        } else {
            ErrorManager::getError(AppConfig::ERROR_MESSAGE[3], __FILE__, __LINE__, __CLASS__, __METHOD__);
            return false;
        }
    }

    /**
     * @param mixed $_email
     */
    public function setEmail($_email)
    {
        if(is_string($_email) && $_email!='') {
            $this->_email = $_email;
            return true;
        } else {
            ErrorManager::getError(AppConfig::ERROR_MESSAGE[3], __FILE__, __LINE__, __CLASS__, __METHOD__);
            return false;
        }
    }

    /**
     * @param mixed $_superuser
     */
    public function setSuperuser($_superuser)
    {
        $this->_superuser = $_superuser;
    }

    /**
     * @param mixed $_create_ts
     */
    public function setCreate_ts($_create_ts)
    {
        $this->_create_ts = $_create_ts;
    }

    /**
     * @param mixed $_update_ts
     */
    public function setUpdate_ts($_update_ts)
    {
        $this->_update_ts = $_update_ts;
    }

    /**
     * @param mixed $_active
     */
    public function setActive($_active)
    {
        $this->_active = $_active;
    }

    public function __construct()
    {

        // TODO - Insert your code here
    }
}

