<?php
class Helpers
{
    public static function baseUrl(string $path = ''): string
    {
        $config = require __DIR__ . '/../../config/config.php';
        $base = isset($config['base_url']) ? trim((string)$config['base_url']) : '';

        if ($base === '' || strtolower($base) === 'auto') {
            $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
            $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
            $scriptDir = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
            $base = $scheme . '://' . $host . $scriptDir;
        }

        $base = rtrim($base, '/');
        $path = ltrim($path, '/');

        return $path === '' ? $base . '/' : $base . '/' . $path;
    }

    public static function redirect(string $path): void
    {
        header('Location: ' . self::baseUrl($path));
        exit;
    }

    public static function e(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
