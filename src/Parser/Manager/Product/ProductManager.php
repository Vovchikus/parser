<?php

namespace Parser\Manager\Product;

use Parser\Entity\Map;
use Parser\Entity\ProductMap;
use PDO;

/**
 * Class ProductManager
 * @package Components\Manager\Product
 */
class ProductManager extends Manager
{

    /**
     * @var string
     */
    private $tableName = 'n58na_virtuemart_products';

    /**
     * @var ProductMap
     */
    private $productMap;

    public function __construct(ProductMap $productMap)
    {
        $this->productMap = $productMap;
        parent::__construct();
    }


    public function selectAll()
    {
        try {
            $prepareQuery = $this->getPdo()->prepare(
                " SELECT product_sku FROM " . $this->getTableName() . " ORDER BY virtuemart_product_id DESC;"
            );
            $prepareQuery->execute();
            return $prepareQuery->fetchAll();

        } catch (\Exception $ex) {
            throw $ex;
        }

    }

    //todo
    public function update()
    {

        try {
            $prepareQuery = $this->getPdo()->prepare(
                "UPDATE " . $this->getTableName() . " SET published = :published WHERE product_sku = :sku"
            );
            $prepareQuery->bindParam(':published', $this->getMap()->getPublished(), PDO::PARAM_INT);
            $prepareQuery->bindParam(':sku', $this->getMap()->getProductSku(), PDO::PARAM_STR);
            $prepareQuery->execute();

        } catch (\Exception $ex) {

            throw $ex;

        }
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @return ProductMap
     */
    public function getMap()
    {
        return $this->productMap;
    }
}