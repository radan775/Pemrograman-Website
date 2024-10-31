<?php

namespace Controllers;

include_once "Traits/ResponseFormatter.php";

use Traits\ResponseFormatter;
use Models\Espresso;
use Models\Latte;

class ProductController extends Controller {
    use ResponseFormatter;

    public function serveEspresso($price, $intensity) {
        $espresso = new Espresso($price, $intensity);
        return $this->formatResponse([
            'type' => 'Espresso',
            'message' => $espresso->serve(),
            'info' => $espresso->getInfo()
        ]);
    }

    public function serveLatte($price, $milkType) {
        $latte = new Latte($price, $milkType);
        return $this->formatResponse([
            'type' => 'Latte',
            'message' => $latte->serve(),
            'info' => $latte->getInfo()
        ]);
    }
}

?>
