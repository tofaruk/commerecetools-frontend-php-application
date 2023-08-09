<?php

namespace App\Route;


use FastRoute\RouteCollector;

class Routes
{
    /**
     * @param RouteCollector $r
     */
    public static function defineRoutes(RouteCollector $r)
    {
        $r->addRoute('GET', '/', 'App\Controller\HomeController::indexAction');


        $r->addGroup('/post', function (RouteCollector $r) {
            $r->addRoute('GET', '', 'App\Controller\PostController::indexAction');
            $r->addRoute('GET', '/details/{id:\d+}', 'App\Controller\PostController::detailsAction');

        });

        $r->addGroup('/catalog', function (RouteCollector $r) {
            $r->addRoute('GET', '', 'App\Controller\CatalogController::indexAction');
            $r->addRoute('GET', '/product/{slug:[a-zA-Z0-9-]+}', 'App\Controller\CatalogController::productAction');
        });
    }
}
