<?php

namespace Parser\Manager\Product;


use Parser\Entity\CategoryMap;
use Parser\Entity\Map;

class CategoryManager extends Manager
{

    /**
     * @var string
     */
    private $tableName = 'n58na_virtuemart_categories';

    /**
     * @var CategoryMap
     */
    private $categoryMap;

    public function getTableName()
    {
        return $this->tableName;
    }

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
        // TODO: Implement getMap() method.
    }
}