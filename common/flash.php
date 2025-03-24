<?php 
class Flash {
    public static function set(string $key, string|array $message): void {
        $_SESSION[$key] = $message;
    }

    public static function get(string $key):  string|array|null {
        if (!isset($_SESSION[$key])) {
            return null;
        }

        $message = $_SESSION[$key];
        unset($_SESSION[$key]); // Auto-remove after reading
        return $message;
    }
}
?>