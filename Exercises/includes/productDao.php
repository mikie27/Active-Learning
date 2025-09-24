<?php

interface ProductDaoInterface {
    public function getProductById($id);
    public function getProducts();
}

// Simple in-memory ProductDao for testing / offline use
class ProductDao implements ProductDaoInterface {
    public function getProductById($id) {
        $products = $this->getProducts();
        return isset($products[$id]) ? $products[$id] : null;
    }

    public function getProducts() {
        // numeric index -> associative product
        return [
            0 => ['id' => 10, 'description' => 'Coke Can', 'size' => '330ml', 'price' => 16.00],
            1 => ['id' => 15, 'description' => 'Coke 8oz', 'size' => '237ml', 'price' => 8.00],
            2 => ['id' => 22, 'description' => 'Coke 12oz', 'size' => '355ml', 'price' => 11.00],
        ];
    }
}

// MySQL-backed implementation using mysqli
class MySQLiProductDao implements ProductDaoInterface {
    private $mysqli;

    public function __construct(mysqli $mysqli) {
        $this->mysqli = $mysqli;
    }

    public function getProductById($id) {
        $sql = "SELECT id, description, size, price FROM products WHERE id = ? LIMIT 1";
        $stmt = $this->mysqli->prepare($sql);
        if (!$stmt) return null;
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }

    public function getProducts() {
        $sql = "SELECT id, description, size, price FROM products ORDER BY id";
        $result = $this->mysqli->query($sql);
        if (!$result) return [];
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    }
}
?>