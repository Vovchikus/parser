<?php

namespace Parser\Database;

use PDO;
use PDOException;

/**
 * Class Database
 * @package Components\Database
 */
class Database
{

    /**
     * @var PDO
     */
    private $connection;
    /**
     * @var
     */
    private static $_instance;
    /**
     * @var string
     */
    private $host = "";
    /**
     * @var string
     */
    private $username = "";
    /**
     * @var string
     */
    private $password = "";
    /**
     * @var string
     */
    private $database = "";

    /**
     * @return Database
     */
    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Database constructor.
     */
    private function __construct()
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->database . ";charset=utf8";
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        try {
            $this->connection = new PDO($dsn, $this->username, $this->password, $opt);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            die("A database error was encountered -> " . $e->getMessage());
        }

    }


    private function __clone()
    {
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
}