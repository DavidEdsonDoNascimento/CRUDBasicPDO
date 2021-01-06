<?php

namespace Alura\Pdo\DAO;
use PDO;

final class Connection {
    private static $DB = 'curso_pdo_alura';
    private static $HOST = 'localhost';
    private static $USER = 'root';
    private static $PASS = 'root';
    
    private static $instance = null;
    
    private function __construct() 
    {
        die('A função Init nao é permitido!');
    }
    
    public static function getConnection()
    {
        if(empty(self::$instance))
        {
            try
            {
                self::$instance =  new PDO( "mysql:host=".self::$HOST.";"."dbname=".self::$DB, self::$USER, self::$PASS); 
            }
            catch(PDOException $exception)
            {
                die($exception->getMessage());
            }
        }
        return self::$instance;
    }
    
    public static function desconectar()
    {
        self::$instance = null;
    }
}
?>