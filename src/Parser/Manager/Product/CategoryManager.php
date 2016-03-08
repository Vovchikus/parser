<?php

namespace Parser\Manager\Product;


use Parser\Entity\CategoryMap;
use Parser\Entity\Map;

/**
 * Class CategoryManager
 * @package Parser\Manager\Product
 */
class CategoryManager extends DbManager
{

    const TABLE_NAME = 'n58na_virtuemart_product_categories';

    /**
     * @var CategoryMap
     */
    private $categoryMap;

    /**
     * @return string
     */
    public function getTableName()
    {
        return self::TABLE_NAME;
    }

    /**
     * @param CategoryMap $categoryMap
     */
    public function __construct(CategoryMap $categoryMap)
    {
        $this->categoryMap = $categoryMap;
        parent::__construct();
    }


    /**
     * @return Map
     */
    public function getMap()
    {
        return $this->categoryMap;
    }
}