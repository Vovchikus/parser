<?php

require_once('autoloader.php');

$testData = ['name' => 'MyName', 'cost' => 50, 'created' => '2016-01-01'];

$product = new \Components\Entity\Product();
$product->setName($testData['name']);
$product->setCost($testData['cost']);
$product->setCreated($testData['created']);

$productManager = new \Components\Manager\Product\ProductManager($product);
$productManager->insert();
