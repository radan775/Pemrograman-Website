<?php

require_once 'Controllers/Controller.php';
require_once 'Controllers/ProductController.php';
require_once 'Traits/ResponseFormatter.php';
require_once 'Models/Coffee.php';
require_once 'Models/Espresso.php';
require_once 'Models/Latte.php';

use Controllers\ProductController;

$productController = new ProductController();

echo $productController->serveEspresso(3.5, 7);
echo "\n";
echo $productController->serveLatte(4.5, "Oat Milk");

?>
