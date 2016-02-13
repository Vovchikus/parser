<?php

namespace Components\Entity;

/**
 * Class Product
 * @package Components\Entity
 */
class Product
{

    /**
     * @var int;
     */
    private $virtuemart_product_id;

    /**
     * @var int
     */
    private $virtuemart_vendor_id;


    /**
     * @var int
     */
    private $product_parent_id;

    /**
     * @var string
     */
    private $product_sku;

    /**
     * @var string
     */
    private $product_gtin;

    /**
     * @var string
     */
    private $product_mpn;

    /**
     * @var float
     */
    private $product_weight;

    /**
     * @var string
     */
    private $product_weight_uom;

    /**
     * @var float
     */
    private $product_length;

    /**
     * @var float
     */
    private $product_width;

    /**
     * @param int $virtuemart_product_id
     */
    public function setVirtuemartProductId($virtuemart_product_id)
    {
        $this->virtuemart_product_id = $virtuemart_product_id;
    }

    /**
     * @param int $virtuemart_vendor_id
     */
    public function setVirtuemartVendorId($virtuemart_vendor_id)
    {
        $this->virtuemart_vendor_id = $virtuemart_vendor_id;
    }

    /**
     * @param int $product_parent_id
     */
    public function setProductParentId($product_parent_id)
    {
        $this->product_parent_id = $product_parent_id;
    }

    /**
     * @param string $product_sku
     */
    public function setProductSku($product_sku)
    {
        $this->product_sku = $product_sku;
    }

    /**
     * @param string $product_gtin
     */
    public function setProductGtin($product_gtin)
    {
        $this->product_gtin = $product_gtin;
    }

    /**
     * @param string $product_mpn
     */
    public function setProductMpn($product_mpn)
    {
        $this->product_mpn = $product_mpn;
    }

    /**
     * @param float $product_weight
     */
    public function setProductWeight($product_weight)
    {
        $this->product_weight = $product_weight;
    }

    /**
     * @param string $product_weight_uom
     */
    public function setProductWeightUom($product_weight_uom)
    {
        $this->product_weight_uom = $product_weight_uom;
    }

    /**
     * @param float $product_length
     */
    public function setProductLength($product_length)
    {
        $this->product_length = $product_length;
    }

    /**
     * @param float $product_width
     */
    public function setProductWidth($product_width)
    {
        $this->product_width = $product_width;
    }

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