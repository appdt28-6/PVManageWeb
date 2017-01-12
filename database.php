<?php
class Database 
{
	/*private static $dbName = 'pvmanager' ; 
	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'root';
	private static $dbUserPassword = '@ppdt';*/
	
	private static $dbName = 'db_a09b1f_pv' ; 
	private static $dbHost = 'mysql5006.smarterasp.net' ;
	private static $dbUsername = 'a09b1f_pv';
	private static $dbUserPassword = '@ppDT2016.';
	
	private static $cont  = null;
	
	public function __construct() {
		exit('Init function is not allowed');
	}
	
	public static function connect()
	{
	   // One connection through whole application
       if ( null == self::$cont )
       {      
        try 
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
        }
        catch(PDOException $e) 
        {
          die($e->getMessage());  
        }
       } 
       return self::$cont;
	}
	
	public static function disconnect()
	{
		self::$cont = null;
	}
}
?>