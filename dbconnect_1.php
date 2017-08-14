<?php
//rename this file as dbconnect.php after filling the correct details below

//connecting to database
class Database  {
        private static $dbName = 'database name' ;
        private static $dbHost = 'localhost' ;
        private static $dbUsername = 'username';
        private static $dbUserPassword = 'password';
         
        private static $cont  = null;
         
        public function __construct() {
            
            die('Init function is not allowed');
        }
         
        //Connecting & Disconnecting from database

        //connecting to database
        public static function connect()    {
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
         
        //disconnecting from database
        public static function disconnect()    {
            
            self::$cont = null;
        }

        //setting type of title
        /*public static function settype($title)	{

			$title = strtolower($title);
			if (strpos($title, 'life' || 'motivation' || 'inspiration' || 'startup' || 'positive' || 'success' || 'courage' || 'perseverance' || 'confucius' || 'happiness' || 'leadership' || 'strength' || 'persistence' || 'love' || 'music' || 'socrates' || 'integrity' || 'funny' || 'seneca' || 'anonymous' || 'running' || 'confidence' || 'business' || 'creativity' || 'friendship' || 'esteem' || 'photography' || 'goal' || 'voltaire' || 'marriage' || 'hardwork' || 'action' || 'time' || 'learn' || 'discipline' || 'failure' || 'winning' || 'wisdom' || 'nature') !== false) {
    			echo "true";
			}
			else 	{
				echo "false";
			}
        }*/

        //inserting each value in database
    	public static function inserttitle($link,$title)    {
        		
        	//set the type of quote
    		$type = "null";
        	//insert data in quotes table
        	$pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO quotes (title,link,type) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($title,$link,$type));
            Database::disconnect();

            return 1;
        }
}
?>