<?php

namespace Models;

class Latte extends Coffee {
    private $milkType;

    public function __construct($price, $milkType) {
        parent::__construct("Latte", $price);
        $this->milkType = $milkType;
    }

    public function serve() {
        return "Serving Latte with milk type: $this->milkType";
    }
}

?>
