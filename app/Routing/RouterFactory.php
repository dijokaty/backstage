<?php declare(strict_types=1);

namespace DJKT\Backstage\Routing;


use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Nette\Routing\Router;

class RouterFactory
{
    public static function create(): Router
    {
        $router = new RouteList();
        $router[] = self::createRatingKioskRouter();

        $router[] = new Route('<presenter>/<action>[/<id>]', 'Common:Homepage');

        return $router;
    }

    private static function createRatingKioskRouter(): Router
    {
        $router = new RouteList('Rating');
        $router[] = new Route('kiosk[/]', 'Kiosk:listScenes');
        $router[] = new Route('kiosk/<sceneId>[/]', 'Kiosk:display');

        return $router;
    }
}