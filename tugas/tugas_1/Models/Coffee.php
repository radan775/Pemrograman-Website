<?php

namespace Models;

abstract class Coffee {
    protected $name;
    protected $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    abstract public function serve();

    public function getInfo() {
        return "Coffee: $this->name, Price: $$this->price";
    }
}

?>
