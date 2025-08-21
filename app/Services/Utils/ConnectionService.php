<?php
namespace App\Services\Utils;

use PDO;

class ConnectionService
{
    public static $instance;

    private function __construct()
    {
        //
    }

    public static function getInstance()
    {
        $url = env('DATABASE_URL');
        $host = env('DB_HOST', '127.0.0.1');
        $port = env('DB_PORT', '3306');
        $database = env('DB_DATABASE', '');
        $username = env('DB_USERNAME', 'root');
        $password = env('DB_PASSWORD', '');
        $dbconnectio = env('DB_CONNECTION', '');
        $tipoHostName = "";
        $tipoDbName = "";
        $separador = "";

        switch ($dbconnectio) {
            case 'sqlsrv':
                $tipoHostName = "server";
                $tipoDbName = "Database";
                $separador = ",";
                break;
            default:
                $tipoHostName = "host";
                $tipoDbName = "dbname";
                $separador = ":";
                break;
        }

        if (!isset(self::$instance)) {
            if ($dbconnectio === 'sqlsrv') {
                self::$instance = new PDO(
                    "$dbconnectio:$tipoHostName=$host$separador$port;$tipoDbName=$database;Encrypt=true;TrustServerCertificate=true",
                    $username,
                    $password
                );
            } else {
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,
                ];

                // ✅ Só adiciona MYSQL_ATTR_INIT_COMMAND se for mysql
                if ($dbconnectio === 'mysql') {
                    $options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8";
                }

                self::$instance = new PDO(
                    "$dbconnectio:$tipoHostName=$host$separador$port;$tipoDbName=$database",
                    $username,
                    $password,
                    $options
                );
            }
        }

        return self::$instance;
    }
}
