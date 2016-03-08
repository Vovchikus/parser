<?php

namespace Parser\Manager\Product;

use Parser\Entity\CategoryMap;
use Parser\Entity\ProductMap;
use PDO;

/**
 * Class ProductManager
 * @package Components\Manager\Product
 */
class ProductManager extends DbManager
{

    const TABLE_NAME = 'n58na_virtuemart_products';

    /**
     * @var ProductMap
     */
    private $productMap;

    public function __construct(ProductMap $productMap)
    {
        $this->productMap = $productMap;
        parent::__construct();
    }

    /**
     * @return ProductMap
     */
    public function getMap()
    {
        return $this->productMap;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return self::TABLE_NAME;
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
     * @param CategoryMap $categoryMap
     * @throws \Exception
     */
    public function insertWithRelatedCategory(CategoryMap $categoryMap)
    {

        try {
            $this->getPdo()->beginTransaction();

            $productId = $this->insert();

            $categoryMap->setVirtuemartProductId($productId);

            $filled = [];
            foreach ($categoryMap->toArray() as $column => $value) {
                if ($value !== null) {
                    $filled[$column] = $value;
                }
            }

            $columnString = implode(',', array_keys($filled));
            $valueString = implode(',', array_fill(0, count($filled), '?'));

            $prepareQuery = $this->getPdo()->prepare(
                "INSERT INTO " . CategoryManager::TABLE_NAME . " ({$columnString}) VALUES ({$valueString})"
            );

            if(!$prepareQuery->execute(array_values($filled))){
                throw new \Exception('Cannot execute query');
            }

            $this->getPdo()->commit();

        } catch (\Exception $ex) {

            $this->getPdo()->rollBack();

            throw $ex;

        }


    }

}