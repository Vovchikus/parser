<?php

namespace Parser\DataParser;

use Parser\Entity\CategoryMap;
use Parser\Entity\ProductMap;
use Parser\Manager\Product\CategoryManager;
use Parser\Manager\Product\ProductManager;
use SimpleXMLElement;
use XMLReader;

class Parser
{
    public function parseAttribute($fileName, $attributeName)
    {
        try {
            $reader = new XMLReader();

            $file = file_get_contents($fileName);

            $reader->xml($file);
            $product = new ProductMap();
            $productManager = new ProductManager($product);
            $existProducts = $productManager->selectAll();
            $ids = [];
            foreach ($existProducts as $productItem) {
                $ids[] = $productItem['product_sku'];
            }
            while ($reader->read() && $reader->name !== $attributeName) {
            }
            $i = -1;
            while ($reader->name === $attributeName) {
                ++$i;
                $element = new SimpleXMLElement($reader->readOuterXml());
                if (in_array(strtoupper($element->vendor), ProductManager::$ignoreVendors)) {
                    continue;
                }
                if (!in_array($element->vendorCode, $ids)) {
                    $product->setProductSku($element->vendorCode);
                    $product->setPublished();
                    $category = new CategoryMap();
                    $category->setVirtuemartCategoryId(CategoryManager::NEW_PRODUCT_CATEGORY_ID);
                    $productManager->insertWithRelatedCategory($category);

                } else {
                    $key = array_search($element->vendorCode, $ids);
                    unset($ids[$key]);
                }
                $reader->next($attributeName);
            }

            if (!empty($ids)) {
                foreach ($ids as $id) {
                    $product->setProductSku($id);
                    $product->setPublished();
                    $productManager->update();
                }
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}
