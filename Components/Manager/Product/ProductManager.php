<?php

namespace Components\Manager\Product;

use Components\Database\Database;
use Components\Entity\Product;

/**
 * Class ProductManager
 * @package Components\Manager\Product
 */
class ProductManager
{

  /**
   * @var string
   */
  private $tableName = 'product';

  /**
   * @var Product
   */
  private $product;

  /**
   * @var \mysqli
   */
  private $mysqli;

  /**
   * ProductManager constructor.
   * @param Product $product
   */
  public function __construct(Product $product)
  {
    $this->product = $product;

    $db = Database::getInstance();
    $this->mysqli = $db->getConnection();
  }

  public function insert()
  {
    try {

      $stmt = $this->mysqli->prepare(
        "INSERT INTO " . $this->tableName . " (name, cost, created) VALUES (?, ?, ?)"
      );

      $stmt->bind_param(
        'sis',
        $this->product->getName(),
        $this->product->getCost(),
        $this->product->getCreated()
      );

      if (!$stmt->execute()) {
        throw new \Exception(sprintf('Unable to insert product'));
      }

      $stmt->close();

    } catch (\Exception $ex) {

      throw $ex;

    }

  }

}