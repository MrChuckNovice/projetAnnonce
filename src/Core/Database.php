<?php
    namespace App\Core;

    use PDO;
    use PDOException;
    
    class Db extends PDO
    {

        // Instance unique via de la classe
        private static $instance;

        private const DBHOST = 'localhost';
        private const DBUSER = 'root';
        private const DBPASS = '';
        private const DBNAME = 'arcade';

        private function __construct()
        {
            // DSN de connexion
            $_dsn = 'mysql:dbname='. self::DBNAME . ';host=' . self::DBHOST;

            try{
                //On appelle le constructeur de la classe PDO
                parent::__construct($_dsn, self::DBUSER, self::DBPASS);

                $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
                $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public static function getInstance():self
        {
            if(self::$instance === null){
                self::$instance = new self();
            }
            return self::$instance;
        }
    }
?>