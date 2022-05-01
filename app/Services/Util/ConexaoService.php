<?php
namespace App\Services\Util;

use PDO;

class ConexaoService
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
        $database = env('DB_DATABASE', 'upa');
        $username = env('DB_USERNAME', 'root');
        $password = env('DB_PASSWORD', '');

        if (!isset(self::$instance)) {
            self::$instance = new PDO("mysql:host=$host;
            dbname=$database", $username, $password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS,
                PDO::NULL_EMPTY_STRING);
        }

        return self::$instance;
    }

}
