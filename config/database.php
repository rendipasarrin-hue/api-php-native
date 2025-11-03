<?php

class Database {
    private static $host = "localhost";
    private static $db_name = "apiphp"; // ganti nama database kamu
    private static $username = "root";
    private static $password = "";
    private static $conn;

    public static function connection() {
        if (!self::$conn) {
            try {
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$db_name,
                    self::$username,
                    self::$password
                );
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // kalau koneksi gagal, tampilkan error
                die("❌ Koneksi GAGAL: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}

// Jika file ini dibuka langsung lewat browser, jalankan pengecekan:
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    try {
        Database::connection();
        echo "✅ Koneksi ke database BERHASIL";
    } catch (Exception $e) {
        echo "❌ Koneksi GAGAL: " . $e->getMessage();
    }
}
