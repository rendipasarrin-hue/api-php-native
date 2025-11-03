<?php
namespace Src\Controllers;

class UserController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        echo json_encode([
            "success" => true,
            "data" => [
                ["id" => 1, "name" => "Admin", "email" => "admin@example.com"],
                ["id" => 2, "name" => "srilius", "email" => "sriliusrendi@example.com"]
            ]
        ]);
    }

    public function show($id) {
        echo json_encode([
            "success" => true,
            "data" => ["id" => $id, "name" => "User $id"]
        ]);
    }

    public function create() {
        $input = json_decode(file_get_contents('php://input'), true);
        // In a real app, validate and save to database
        echo json_encode([
            "success" => true,
            "message" => "User created",
            "data" => ["id" => 3, "name" => $input['name'] ?? 'New User', "email" => $input['email'] ?? 'new@example.com']
        ]);
    }

    public function update($id) {
        $input = json_decode(file_get_contents('php://input'), true);
        echo json_encode([
            "success" => true,
            "message" => "User updated",
            "data" => ["id" => $id, "name" => $input['name'] ?? "Updated User $id"]
        ]);
    }

    public function delete($id) {
        echo json_encode([
            "success" => true,
            "message" => "User $id deleted"
        ]);
    }
}