<?php
namespace Src\Middlewares;

class CorsMiddleware {
    public static function handle(array $cfg) {
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '*';
        $allowed = $cfg['app']['allowed_origins'] ?? [];

        if ($allowed && in_array($origin, $allowed) || $allowed === true) {
            header("Access-Control-Allow-Origin: $origin");
        } else if (empty($allowed)) {
            header("Access-Control-Allow-Origin: *");
        }

        header("Vary: Origin");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE,");
    }
}