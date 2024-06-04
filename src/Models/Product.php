<?php

namespace Models;

use PDO;

class Product {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function create($name, $amount) {
        $stmt = $this->db->prepare("INSERT INTO products (name, created_at, updated_at, amount) VALUES (:name, :created_at, :updated_at, :amount)");
        $stmt->execute([
            'name' => $name,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'amount' => $amount,
        ]);
    }

    public function updateAmount($id, $amount) {
        $stmt = $this->db->prepare("UPDATE products SET amount = :amount, updated_at = :updated_at WHERE id = :id");
        $stmt->execute([
            'id' => $id,
            'amount' => $amount,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}