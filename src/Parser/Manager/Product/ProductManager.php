<?php

namespace Parser\Manager\Product;

use Parser\Database\Database;
use Parser\Entity\Product;

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


    private $pdo;

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
                if ($value !== null) {
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

    public function selectAll()
    {
        try {
            $prepareQuery = $this->pdo->prepare(
                " SELECT product_sku FROM " . $this->tableName . " ORDER BY virtuemart_product_id DESC;"
            );
            $prepareQuery->execute();
            return $prepareQuery->fetchAll();

        } catch (\Exception $ex) {
            throw $ex;
        }

    }

}