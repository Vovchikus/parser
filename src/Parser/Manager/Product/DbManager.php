<?php

namespace Parser\Manager\Product;


use Parser\Database\Database;
use Parser\Entity\Map;

abstract class DbManager
{

    /**
     * @var \PDO
     */
    private $pdo;


    public function __construct()
    {
        $db = Database::getInstance();
        $this->pdo = $db->getConnection();
    }

    /**
     * @return \PDO
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * @return string
     */
    public abstract function getTableName();

    /**
     * @return Map
     */
    public abstract function getMap();


    /**
     * @return string
     * @throws \Exception
     */
    public function insert()
    {
        try {
            $filled = [];
            foreach ($this->getMap()->toArray() as $column => $value) {
                if ($value !== null) {
                    $filled[$column] = $value;
                }
            }
            if (empty($filled)) {
                throw new \Exception('Nothing to insert');
            }

            $columnString = implode(',', array_keys($filled));
            $valueString = implode(',', array_fill(0, count($filled), '?'));
            $prepareQuery = $this->getPdo()->prepare(
                "INSERT INTO " . $this->getTableName() . " ({$columnString}) VALUES ({$valueString})"
            );
            if (!$prepareQuery->execute(array_values($filled))) {
                throw new \Exception('Cannot execute query');
            }
            return $this->getPdo()->lastInsertId();

        } catch (\Exception $ex) {

            throw $ex;

        }

    }


}