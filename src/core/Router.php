<?php declare(strict_types=1);

use JetBrains\PhpStorm\NoReturn;

require_once "Request.php";
require_once "View.php";
require_once "Application.php";
require_once "exceptions/NotFoundException.php";
class Router
{

    private array $routes = [];

    public function getRoutes(): array
    {
        return $this->routes;
    }
    public function addRoute(string $URL, array $params) : void
    {

        $URL = preg_replace('/(\/+)/','/',$URL);
        $URL = rtrim($URL,'/');
        $route = "/^".str_replace('/','\/',$URL) . "([\/]?)*$/";
        $this->routes[$route] = $params;
    }
    public function resolve(Request $request): void
    {

        $route = $this->routes[$this->findRoute($request->getPath())];
        require_once $_SERVER['DOCUMENT_ROOT'] . "/src/controllers/" . $route[0] . '.php';
        $controller = new $route[0];
        $callback = [$controller, $route[1]];
        call_user_func($callback, $request);

    }
    public function findRoute(string $URL) : string
    {
        foreach ($this->routes as $key => $value) {
            if (preg_match($key, $URL)) {
                return $key;
            }
        }
        throw new NotFoundException();
    }
    #[NoReturn] public function redirect(string $URL) : void
    {
        header("Location: ".$URL);
        exit;
    }
}