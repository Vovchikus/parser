<?php

namespace Components\Entity;

class Product
{

  private $name;

  private $cost;

  private $created;

  /**
   * @return mixed
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @param mixed $name
   */
  public function setName($name)
  {
    $this->name = $name;
  }

  /**
   * @return mixed
   */
  public function getCost()
  {
    return $this->cost;
  }

  /**
   * @param mixed $cost
   */
  public function setCost($cost)
  {
    $this->cost = $cost;
  }

  /**
   * @return mixed
   */
  public function getCreated()
  {
    return $this->created;
  }

  /**
   * @param mixed $created
   */
  public function setCreated($created)
  {
    $this->created = $created;
  }



}