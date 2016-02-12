<?php

namespace Components\Database;

use mysqli;

/**
 * Class Database
 * @package Components\Database
 */
class Database
{
  /**
   * @var mysqli
   */
  private $connection;
  /**
   * @var
   */
  private static $_instance;
  /**
   * @var string
   */
  private $host = "localhost";
  /**
   * @var string
   */
  private $username = "root";
  /**
   * @var string
   */
  private $password = "19700505";
  /**
   * @var string
   */
  private $database = "symfony";

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
    $this->connection = new mysqli($this->host, $this->username,
      $this->password, $this->database);

    // Error handling
    if (mysqli_connect_error()) {
      trigger_error("Failed to connect to MySQL: " . mysqli_connect_error(),
        E_USER_ERROR);
    }
  }


  private function __clone()
  {
  }

  /**
   * @return mysqli
   */
  public function getConnection()
  {
    return $this->connection;
  }
}