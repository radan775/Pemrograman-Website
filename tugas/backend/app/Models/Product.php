<?php
namespace app\Models;

use app\Traits\Timestamps;
use PDO;

class Product {
    use Timestamps;

    private $conn;
    private $table = 'products';

    public $id;
    public $nama_product;
    public $harga_product;
    public $stok_product;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllProducts() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createProduct() {
        $this->setTimestamps();

        $query = "INSERT INTO " . $this->table . " (nama_product, harga_product, stok_product, created_at, updated_at) 
                  VALUES (:nama_product, :harga_product, :stok_product, :created_at, :updated_at)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama_product', $this->nama_product);
        $stmt->bindParam(':harga_product', $this->harga_product);
        $stmt->bindParam(':stok_product', $this->stok_product);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);

        return $stmt->execute();
    }

    public function updateProduct() {
        $this->updateTimestamp();

        $query = "UPDATE " . $this->table . " 
                  SET nama_product = :nama_product, harga_product = :harga_product, stok_product = :stok_product, updated_at = :updated_at 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':nama_product', $this->nama_product);
        $stmt->bindParam(':harga_product', $this->harga_product);
        $stmt->bindParam(':stok_product', $this->stok_product);
        $stmt->bindParam(':updated_at', $this->updated_at);

        return $stmt->execute();
    }

    public function deleteProduct() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
}
?>
