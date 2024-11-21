<?php
namespace app\Routes;

use app\Config\ConfigDatabase;
use app\Controller\ProductController;

require_once 'ConfigDatabase.php';
require_once 'Controllers/ProductController.php';

$db = (new ConfigDatabase())->connect();
$productController = new ProductController($db);

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_URI'] === '/products') {
    if ($requestMethod === 'GET') {
        echo json_encode($productController->index());
    } elseif ($requestMethod === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($productController->store($data));
    }
} elseif (preg_match('/\/products\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {
    $id = $matches[1];

    if ($requestMethod === 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($productController->update($id, $data));
    } elseif ($requestMethod === 'DELETE') {
        echo json_encode($productController->destroy($id));
    }
}
?>
