<?php

final class Database
{

    private static ?PDO $connection = null;

    public static function connect(): PDO
    {
        if (self::$connection === null) {
            
            $host = "localhost";
            $user = "root";
            $pass = "";
            $dbname = "maffin_task";
            $charset = "utf8mb4";

            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

            try {
                self::$connection = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                die("Verilənlər bazasına qoşulma uğursuz oldu: " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}