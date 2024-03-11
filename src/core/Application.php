<?php declare(strict_types=1);

require_once "Router.php";
require_once "View.php";
class Application
{
    private static bool $initialized = false;
    private static array $Database;
    private static Router $Router;
    public static function getDatabase(): array
    {
        return self::$Database;
    }


    public static function getRouter(): Router
    {
        return self::$Router;
    }
    public static function init(array $database) : void
    {
        if (!self::$initialized)
        {
            self::$initialized = true;
            self::$Database = $database;
            self::$Router = new Router();
        }
    }
    public static function run(): void
    {
        try
        {
            self::getRouter()->resolve(new Request());
        }
        catch (Exception $e)
        {
            http_response_code($e->getCode());
            $view = new View();
            echo $view->RenderViewOnly((string)$e->getCode());
        }
    }
}