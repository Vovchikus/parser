<?php

namespace Parser\DataParser;

use Parser\Entity\Product;
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

            $product = new Product();
            $productManager = new ProductManager($product);
            $existProducts = $productManager->selectAll();

            $ids = [];
            foreach ($existProducts as $product) {
                $ids[] = $product['product_sku'];
            }

            while ($reader->read() && $reader->name !== $attributeName) {
            }

            $i = -1;

            while ($reader->name === $attributeName) {

                ++$i;
                if ($i < 1) {

                    $element = new SimpleXMLElement($reader->readOuterXml());
                    if (!in_array($element->vendorCode, $ids)) {

                        $product->setProductSku($element->vendorCode);
                        //Если товар новый - не публикуем
                        $product->setPublished(0);
                        $productManager->insert();

                    }

                    $reader->next($attributeName);
                    continue;
                }

                $reader->next($attributeName);
            }


        } catch (\Exception $ex) {

            print_r($ex->getMessage());
            die;

        }

    }


}