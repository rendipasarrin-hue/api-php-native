<?php
namespace Src\Controllers;

class UserController {
    public function index() {
        echo json_encode([
            "success" => true,
            "data" => [
                ["id" => 1, "name" => "Admin", "email" => "admin@example.com"],
                ["id" => 2, "name" => "Srilius", "email" => "sriliusrendi@example.com"]
            ]
        ]);
    }

    public function show($id) {
        echo json_encode([
            "success" => true,
            "data" => ["id" => $id, "name" => "User $id"]
        ]);
    }
}