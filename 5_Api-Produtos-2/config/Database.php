<?php

class DataBase{
    private static $host = "localhost";
    private static $db_name = "e_commerce_db";
    private static $username = "root";
    private static $passwd = "bancodedados";
    private static ?PDO $conn = null;

    public static function getConnection():PDO{
        if(self::$conn === null){
            try{
                self::$conn = new PDO(
                    "mysql::host = " . self::$host . "; db_name = " . self::$db_name,
                    self::$username,
                    self::$passwd,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            }catch(PDOException $e){
                http_response_code(500);
                echo json_encode(["erro" => "Falha de conexão com o banco de dados"]);

                exit;
            }
        }

        return self::$conn;
    }
}

?>