<?
class PDOPlusStatement extends PDOStatement
{
	public $dbh;
 
	protected $p_params;
 
	public static $sql;
	public static $requetes;
	public static $cache_est_actif = false;				// active l'historique des objets statments;
	public static $cache_requete_est_actif = false;		// active l'historique des requetes;
 
	protected function __construct($dbh)
	{
		$this->dbh = $dbh;
		$this->p_params = array();
 
		if( self::$cache_est_actif )
		{
			if( self::$sql == null )
				self::$sql = array();
			self::$sql[] = $this;
		}
	}
 
	public function execute()
	{
		if( self::$cache_requete_est_actif )
		{
			if( self::$requetes == null )
				self::$requetes = array();
			self::$requetes[] = $this->debugRequete();
		}
		return parent::execute();
	}
 
	public function bindParam ( $parameter, 
								$variable , 
								$data_type = NULL ,  
								$length = NULL ,  
								$driver_options = array() )
	{
		if( is_bool($variable) && $data_type == PDO::PARAM_INT ){ $variable = intval($variable); }
 
		$param 						= array();
		$param["parameter"] 		= $parameter;
		$param["variable"] 			= $variable;
		$param["data_type"] 		= $data_type;
		$param["length"] 			= $length;
		$param["driver_options"] 	= $driver_options;
		$this->p_params[] 			= $param;
 
		return parent::bindParam($parameter,$variable,$data_type,$length,$driver_options);
	}
 
	public function debugRequete()
	{
		$retour = $this->queryString;
		foreach( $this->p_params as $param )
		{
			switch( $param["data_type"] )
			{
				case PDO::PARAM_STR:
					/*
					$pattern 	= '/('.$param["parameter"].')[/s]{0,}[,]{0,}/i';
					$matches 	= array();
					preg_match($pattern, $retour, $matches );
					if( count() == 0 )
					{
						echo "pattern : ".$pattern."\n";
						die(var_dump($matches));
					}
					*/
 
					$pattern 		= '`('.preg_quote("".$param["parameter"]).')([\s]{0,}[,]{0,})`i';
					$replacement 	= "'".($param["variable"])."'$2";
					$tmp			= $retour;
					$tmp = preg_replace($pattern, $replacement, $tmp , 1 );
					if( $retour == $tmp )
					{
						echo "pattern : ".$pattern."\n";
						echo "retour : ".$retour."\n";
					}
					$retour = $tmp;
 
					//$retour = str_replace($param["parameter"]."" , "'".$param["variable"]."'" , $retour );
				break;
				default:
					/*
					$pattern 	= '/('.$param["parameter"].')[/s]{0,}[,]{0,}/i';
					$matches 	= array();
					preg_match($pattern, $retour, $matches );
					if( count() == 0 )
					{
						echo "pattern : ".$pattern."\n";
						die(var_dump($matches));
					}
					*/
 
					$pattern 		= '`('.preg_quote("".$param["parameter"]).')([\s]{0,}[,]{0,})`i';
					$replacement 	= "".($param["variable"])."$2";
					$tmp			= $retour;
					$tmp = preg_replace($pattern, $replacement, $tmp , 1);
					if( $retour == $tmp )
					{
						echo "pattern : ".$pattern."\n";
						echo "retour : ".$retour."\n";
					}
					$retour = $tmp;
 
					// $retour = str_replace($param["parameter"]."" , $param["variable"]."" , $retour );
				break;
			}
		}
		return $retour;
	}
}
?>