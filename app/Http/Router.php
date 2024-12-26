<?php

namespace App\Http;

class Router
{
    public $currentRoute;

    public function __construct()
    {
        $this->currentRoute = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public static function runCallbackFunc(string $route, callable|array $callback): void
    {
        if (gettype($callback) == 'array') {
            $resourceValue = self::getResource($route);
            if ($resourceValue) {
                $resourceRoute = str_replace('{id}', $resourceValue, $route);
                if ($resourceRoute == self::getResource()) {
                    (new $callback[0])->{$callback[1]};
                    exit();
                }
            }
            if ($route == self::getRoute()) {
                (new $callback[0])->{$callback[1]}();
                exit();
            }
        }
        $resourceValue = self::getResource($route);
        if ($resourceValue) {
            $resourceRoute = str_replace('{id}', $resourceValue, $route);
            if ($resourceRoute == self::getResource()) {
                var_dump((new $callback[0])->show());
                exit();
            }
        }
        if ($route == self::getRoute()) {
            callback();
            exit();
        }
    }

    public static function getRoute(): false|array|int|string|null {
        return (new static())->currentRoute;
    }

    public static function getResource($route): false|string
    {
        $resourceIndex = mb_stripos($route, '{id}');
        if (!$resourceIndex) {
            return false;
        }
        $resourceValue = substr(self::getRoute(), $resourceIndex);
        if ($limit = mb_stripos($resourceValue, '/')) {
            return substr($resourceValue, 0, $limit);
        }
        return $resourceValue ?: false;
    }

    public static function get($route, $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            self::runCallbackFunc($route, $callback);
        }
    }

    public static function post($route, $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            self::runCallbackFunc($route, $callback);
        }
    }

    public static function putApi($route, $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            self::extracted($route, $callback);
        }
    }

    public static function put($route, $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['_method']) && strtoupper($_POST['_method']) === 'PUT') {
            self::runCallbackFunc($route, $callback);
        }
    }

    public static function delete($route, $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            self::extracted($route, $callback);
        }
    }

    public static function extracted($route, $callback): void
    {
        $resourceValue = self::getResource($route);
        if ($resourceValue) {
            $resourceRoute = str_replace('{id}', $resourceValue, $route);
            if ($resourceRoute == self::getResource()) {
                $callback($resourceValue);
                exit();
            }
        }
        if ($route == self::getRoute()) {
            $callback();
            exit();
        }
    }

    public static function isApiCall(): bool
    {
        return mb_stripos($_SERVER['REQUEST_URI'], '/api') === 0;
    }

    public static function isTelegram(): bool
    {
        return mb_stripos($_SERVER['REQUEST_URI'], '/telegram') === 0;
    }
}