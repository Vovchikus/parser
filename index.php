<?php

require_once('autoloader.php');

$testData = ['name' => 'MyName', 'cost' => 50, 'created' => '2016-01-01'];

$product = new \Components\Entity\Product();
$product->setProductLength(1.2);
$product->setProductSku('MYSKU');

$productManager = new \Components\Manager\Product\ProductManager($product);
$productManager->insert();
