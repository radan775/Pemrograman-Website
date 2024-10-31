<?php

namespace Models;

class Espresso extends Coffee {
    private $intensity;

    public function __construct($price, $intensity) {
        parent::__construct("Espresso", $price);
        $this->intensity = $intensity;
    }

    public function serve() {
        return "Serving Espresso with intensity level: $this->intensity";
    }
}

?>
