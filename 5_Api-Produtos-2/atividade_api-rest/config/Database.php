<?php
class Database {
    private static $host = "localhost";
    private static $db_name = "e_commerce_db";
    private static $username = "root";
    private static $password = "bancodedados";
    private static ?PDO $conn=null;
    
    public static function getConnection():PDO{
        if(self::$conn===null){
            try{
                self::$conn=new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$db_name,
                    self::$username,
                    self::$password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );

            }catch (PDOException $e){
                http_response_code(500);
                echo json_encode(["erro"=>"Falha de conexao com o banco de dados"]);
                echo $e->getMessage(); // Para ver o erro do sistema
                exit;

            }
        }
        return self::$conn;
    }
}