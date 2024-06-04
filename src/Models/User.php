<?php

namespace Models;

use PDO;

class User {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function create($access_code) {
        $stmt = $this->db->prepare("INSERT INTO users (access_code, created_at) VALUES (:access_code, :created_at)");
        $stmt->execute([
            'access_code' => $access_code,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function verifyAccessCode($access_code) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE access_code = :access_code");
        $stmt->execute(['access_code' => $access_code]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}