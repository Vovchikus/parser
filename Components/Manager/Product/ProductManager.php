<?php

namespace Components\Manager\Product;

use Components\Database\Database;
use Components\Entity\Product;
use ReflectionClass;

/**
 * Class ProductManager
 * @package Components\Manager\Product
 */
class ProductManager
{

    /**
     * @var string
     */
    private $tableName = 'n58na_virtuemart_products';

    /**
     * @var Product
     */
    private $product;


    private $pdo;

    /**
     * ProductManager constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;

        $db = Database::getInstance();
        $this->pdo = $db->getConnection();
    }

    public function insert()
    {
        try {
            $filled = [];
            foreach ($this->product->toArray() as $column => $value) {
                if ($value) {
                    $filled[$column] = $value;
                }
            }
            if (empty($filled)) {
                throw new \Exception('Nothing to insert');
            }

            $columnString = implode(',', array_keys($filled));
            $valueString = implode(',', array_fill(0, count($filled), '?'));
            $prepareQuery = $this->pdo->prepare(
                "INSERT INTO " . $this->tableName . " ({$columnString}) VALUES ({$valueString})"
            );
            $prepareQuery->execute(array_values($filled));

        } catch (\Exception $ex) {

            throw $ex;

        }

    }

}