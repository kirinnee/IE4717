<?php

class Coffee {
    public $id;
    public $name;
    public $desc;
    public $types;
  
    function __construct($id, $name, $desc) {
      $this->name = $name;
      $this->id = $id;
      $this->desc = $desc;
      $this->types = array();
    }

    function addType($type) {
        $this->types = array_merge($this->types, array($type));
    }
}

class CoffeeType {
    public $id;
    public $name;
    public $price;
    public $realId;

    function __construct($id, $name, $price, $realId) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->realId = $realId;
    }
}
  

?>