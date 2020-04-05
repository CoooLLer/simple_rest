<?php

namespace App\Core;

use Exception;

class Router
{
    private array $routes;

    private array $matchedRoute;

    private array $params;

    public function __construct(array $routes)
    {
        if (!is_array($routes)) {
            throw new Exception('Wrong routes parameter.');
        }
        $this->routes = $routes;
    }

    public function matchRoute(string $checkRoute, string $method): bool
    {
        foreach ($this->routes as $route) {
            if (preg_match($route['path'], $checkRoute, $matches) && in_array($method, $route['methods'])) {
                $this->matchedRoute = $route;
                //удалим элемент с полным совпадением
                $matches = array_slice($matches, 1);

                //вытащим параметры в соответствии с настройками роута
                foreach ($matches as $key => $match) {
                    $this->params[] = $match;
                }
                return true;
            }
        }

        return false;
    }

    public function dispatch()
    {
        //рассчитываем только на запросы из задания, отрезание строки после "?" и парсинг query параметров не делаем
        $requestURI = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if (!$this->matchRoute($requestURI, $requestMethod)) {
            throw new Exception(sprintf('No route found for query %s', $requestURI));
        }

        $controller = Kernel::getInstance()->getConfig()['controllers_namespace'] . '\\' . $this->matchedRoute['controller'];


        if (class_exists($controller)) {
            $controller_object = new $controller();
            $action = $this->matchedRoute['action'];

            //пока нам нужен только PUT для вытаскивания данных запроса и подразумеваем, что входящие данные json
            if (in_array($requestMethod, ['PUT'])) {
                $data = json_decode(file_get_contents("php://input"));
                $this->params[] = $data;
            }

            $controller_object->$action(...$this->params);


        } else {
            throw new Exception(sprintf("Controller class %s not found", $controller));
        }


    }
}