<?php
namespace app\Controller;

use app\Models\Product;

class ProductController {
    private $product;

    public function __construct($db) {
        $this->product = new Product($db);
    }

    public function index() {
        $result = $this->product->getAllProducts();
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function store($data) {
        $this->product->nama_product = $data['nama_product'];
        $this->product->harga_product = $data['harga_product'];
        $this->product->stok_product = $data['stok_product'];

        return $this->product->createProduct();
    }

    public function update($id, $data) {
        $this->product->id = $id;
        $this->product->nama_product = $data['nama_product'];
        $this->product->harga_product = $data['harga_product'];
        $this->product->stok_product = $data['stok_product'];

        return $this->product->updateProduct();
    }

    public function destroy($id) {
        $this->product->id = $id;
        return $this->product->deleteProduct();
    }
}
?>
