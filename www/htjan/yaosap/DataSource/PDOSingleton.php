<?php
namespace htjan\yaosap\DataSource;

use htjan\yaosap\AppConfig;

class PDOSingleton
{
    /**
     * Instance de la classe PDO
     *
     * @var \PDO
     * @access private
     */
    private $PDOInstance = null;
    
    /**
     * Instance de la classe SPDO
     *
     * @var SPDO
     * @access private
     * @static
     */
    private static $instance = null;
    
    /**
     * Constructeur
     *
     * @param void
     * @return void
     * @see \PDO::__construct()
     * @access private
     */
    private function __construct()
    {
        $this->PDOInstance = new \PDO('mysql:host='.AppConfig::DATABASE_HOST.';dbname='.AppConfig::DATABASE_NAME, AppConfig::DATABASE_USER, AppConfig::DATABASE_PASSWORD);
    }
    
    /**
     * Crée et retourne l'objet SPDO
     *
     * @access public
     * @static
     * @param void
     * @return SPDO $instance
     */
    public static function getInstance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new PDOSingleton();
        }
        return self::$instance;
    }
    
    public function query($query)
    {
        return $this->PDOInstance->query($query);
    }
    
    public function prepare($query)
    {
        return $this->PDOInstance->prepare($query);
    }
    
    public function exec($query)
    {
        return $this->PDOInstance->exec($query);
    }
    
    public function lastInsertId ()
    {
        return $this->PDOInstance->lastInsertId();
    }
    
}