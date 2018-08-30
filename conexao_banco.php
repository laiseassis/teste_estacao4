<?php

class Conexao
{
    private static $host = 'localhost';
    private static $user = 'root';
    private static $password = '';
    private static $database = 'teste_estacao4';
	
    private static $cont = null;
    
    public function __construct() 
    {
        die('Não Autorizado!');
    }
    
    public static function conect()
    {
        if(null == self::$cont)
        {
            try
            {
                self::$cont =  new PDO( "mysql:host=".self::$host.";"."dbname=".self::$database, self::$user, self::$password); 
            }
            catch(PDOException $exception)
            {
                die($exception->getMessage());
            }
        }
        return self::$cont;
    }
    
    public static function desconect()
    {
        self::$cont = null;
    }
}

?>
