<?php

namespace App\Core;


class RouteHandler
{
    /**
     * @param $routeInfo
     * @param Request $request
     * @return mixed|string
     */
    public static function found($routeInfo, Request $request)
    {
        $handler = $routeInfo[1];
        if ($handler instanceof \Closure) {
            return $handler();
        }
        $vars = $routeInfo[2];
        list($controller, $method) = explode("::", $handler);
        if (!class_exists($controller) || !method_exists($controller, $method)) {
            return self::routeHandlerNotFound();
        }
        $controller = new $controller;
        return $controller->$method($request, $vars);
    }

    /**
     * @return string
     */
    public static function routeHandlerNotFound()
    {
        return '<h2>Route handler not found</h2>';
    }

    /**
     * @return string
     */
    public static function notFound()
    {
        return '<h2>404 Not Found</h2>';
    }

    /**
     * @param $allowedMethods
     * @return string
     */
    public static function methodNotAllowed($allowedMethods)
    {
        return '<h2> 405 Method Not Allowed</h2>';
    }
}
