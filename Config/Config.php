<?php 

class Config {
    private static array $env = [];
    private static bool $loaded = false;

    public static function load() : void {
        if (self::$loaded) return;
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
        $dotenv->load();
        self::$env = $_ENV;
        self::$loaded = true;
    }

    public static function get(string $key, $default = ''): string {
        return self::$env[$key] ?? $default;
    }
}
