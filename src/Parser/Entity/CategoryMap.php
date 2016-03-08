<?php

namespace Parser\Entity;
use Parser\Manager\Product\CategoryManager;

/**
 * Class CategoryMap
 * @package Parser\Entity
 */
class CategoryMap extends Map
{

    /**
     * @var integer
     */
    private $virtuemart_product_id;

    /**
     * @var integer
     */
    private $virtuemart_category_id;

    /**
     * @var boolean
     */
    private $ordering;

    /**
     * @return int
     */
    public function getVirtuemartProductId()
    {
        return $this->virtuemart_product_id;
    }

    /**
     * @param int $virtuemart_product_id
     */
    public function setVirtuemartProductId($virtuemart_product_id)
    {
        $this->virtuemart_product_id = $virtuemart_product_id;
    }

    /**
     * @return int
     */
    public function getVirtuemartCategoryId()
    {
        return $this->virtuemart_category_id;
    }

    /**
     * @param int $virtuemart_category_id
     */
    public function setVirtuemartCategoryId($virtuemart_category_id)
    {
        $this->virtuemart_category_id = $virtuemart_category_id;
    }

    /**
     * @return boolean
     */
    public function isOrdering()
    {
        return $this->ordering;
    }

    /**
     * @param boolean $ordering
     */
    public function setOrdering($ordering)
    {
        $this->ordering = $ordering;
    }


    /**
     * @return array
     */
    public function toArray()
    {
        $vars = get_object_vars($this);
        $result = [];
        foreach ($vars as $key => $value) {
            $result[$key] = $value;
        }
        return $result;
    }
}