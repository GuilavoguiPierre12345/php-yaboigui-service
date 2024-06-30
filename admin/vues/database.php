<?php

/**
 * pout utiiser une variable static (variable de classe) dans une fonction static de cette même
 * classe, on précède le nom de la variable par : self:: dans la fonction
 * 
 * pour utiliser une variable d'instance (variable d'objet) dans un getter ou setter de cette même
 * classe, on précède le nom de la varible par: $this
 */

class Database{
    
    private static $dbhost = "localhost";
    private static $dbname = "yaboiguiservice";
    private static $dbuser = "root";
    private static $dbpsword ="";
    

    private static  $connection = null;

    public static function connect()
    {
        try{
            self::$connection = new PDO("mysql:host=".self::$dbhost.";dbname=".self::$dbname,self::$dbuser,self::$dbpsword);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
        }catch(PDOException $e){
            die($e->getMessage());
        }
        return self::$connection;
    }

    public static function disconnect(){
        self::$connection = null;
    }
}
