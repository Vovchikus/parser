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

            if (!$reader->open($fileName)) {
                throw new \Exception(sprintf('Unable to open file', $fileName));
            }

            $product = new Product();
            $productManager = new ProductManager($product);
            $products = $productManager->selectAll();

            $ids = [];
            foreach ($products as $item) {
                $ids[] = $item['product_sku'];
            }


            while ($reader->read()) {
                switch ($reader->nodeType) {
                    case(XMLREADER::ELEMENT):
                        if ($reader->localName == $attributeName) {
                            $reader->moveToElement();
                            $element = new SimpleXMLElement($reader->readOuterXml());
                            if (!in_array($element->vendorCode, $ids)) {
                                $product->setProductSku($element->vendorCode);
                                $productManager->insert();
                            }
                        }
                }
            }
            $reader->close();


        } catch (\Exception $ex) {

            print_r($ex->getMessage());
            die;

        }

    }


}