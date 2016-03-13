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
                if ($i < 2) {
                    $element = new SimpleXMLElement($reader->readOuterXml());

                    if(in_array(strtoupper($element->vendor), ProductManager::$ignoreVendors)){
                        continue;
                    }

                    //товар новый
                    if (!in_array($element->vendorCode, $ids)) {
                        $product->setProductSku($element->vendorCode);
                        //не публикуем
                        $product->setPublished(0);

                        $category = new CategoryMap();
                        $category->setVirtuemartCategoryId(CategoryManager::NEW_PRODUCT_CATEGORY_ID);

                        $productManager->insertWithRelatedCategory($category);

                    //товар существует
                    } else {
                        $key = array_search($element->vendorCode, $ids);
                        unset($ids[$key]);
                    }
                    $reader->next($attributeName);
                    continue;
                }

                $reader->next($attributeName);
            }


            //Есть в базе, но нет в xml (деактивируем)
            if (!empty($ids)) {
                foreach($ids as $id){
                    $product->setProductSku($id);
                    $product->setPublished(0);
                    $productManager->update();
                }


            }


        } catch (\Exception $ex) {

            print_r($ex->getMessage());
            die;

        }

    }


}