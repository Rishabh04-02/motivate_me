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
         //get id of the title supplied
        public static function getid($name)  {

            echo $name;
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT id FROM quotes WHERE title = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $a = $data['id']."\n";
            Database::disconnect();

            return $a;
        }

        //inserting va
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

        //this assigns unique id's to the title and links
        public static function assignid($j)   {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //UPDATE `quotes` SET `id` = '100' WHERE `quotes`.`title` = 'Abdul Kalam Quotes';
            $sql = "SELECT id,title FROM `quotes` WHERE id=0 LIMIT 1";
            $q = $pdo->prepare($sql);
            $q->execute();
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $a = $data['id'];
            $b = $data['title'];

            $sql = "UPDATE `quotes` SET `id` = ? WHERE `title` = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($j,$b));
            Database::disconnect();   

            echo $j." - ".$b;
            return 1;
        }

        //get id of the title supplied
        public static function getid($name)  {

            echo $name;
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT id FROM quotes WHERE title = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $a = $data['id']."\n";
            Database::disconnect();

            return $a;
        }

        //inserting value in tags 
        public static function addtags($id,$tag)    {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO tags (id,tag) VALUES (?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($id,$tag));
            Database::disconnect();

            return 1;
        }
}
?>