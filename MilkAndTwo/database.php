<?php
class Database
{
	// From: https://www.startutorial.com/articles/view/php-crud-tutorial-part-1
	private static $dbName = 'samplecustomers';
	private static $dbHost = 'localhost';
	private static $dbUsername = 'root';
	private static $dbUserPassword = 'root';      // root or Fookoothea1075
	
	private static $cont = null;
	
	public function __construct()
	{
		die('Init function is not allowed');				// To prevent misuse of the function
	}
	
	// Main function of the class. Currently, the only connection in the application. Since a static method, we will use 'Database::connect()' to create a connection
	public static function connect()
	{
		// One connection through the whole application
		if (null == self::$cont)
		{
			try{
				self::$cont = new PDO("mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
			}
			catch (PDOException $e)
			{
				die($e->getMessage()); 
			}
		}
		return self::$cont;
	}
	
	// Set the connection to null to disconnect from DB
	public static function disconnect()
	{
		self::$cont = null;
	}
}
?>