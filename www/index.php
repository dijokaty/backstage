<?php declare(strict_types=1);

use Nette\Application\Application;

/** @var \Nette\DI\Container $container */
$container = require dirname(__DIR__) . '/app/bootstrap.php';

/** @var Application $app */
$app = $container->getByType(Application::class);

$app->run();
