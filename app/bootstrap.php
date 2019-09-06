<?php declare(strict_types=1);

namespace DJKT;

use Nette\Configurator;
use Tracy\Debugger;

require __DIR__ . '/../vendor/autoload.php';

return call_user_func(static function () {
    Debugger::$showLocation = true;
    Debugger::$maxDepth = 4;
    $configurator = new Configurator();
    if (getenv('DEBUG_MODE')) {
        $configurator->setDebugMode(true);
    } else {
        $debugList = [];
        $configurator->setDebugMode($debugList);
    }

    $configurator->addParameters([
        'rootDir' => dirname(__DIR__),
    ]);
    $configurator->enableDebugger(dirname(__DIR__) . '/log');
    $configurator->setTempDirectory(dirname(__DIR__) . '/temp');

    $configurator->addConfig(__DIR__ . '/config/config.neon');
    $configFile = getenv('CONFIG_FILE') ?: 'config.local.neon';
    $configurator->addConfig(__DIR__ . '/config/' . $configFile);

    $container = $configurator->createContainer();
    return $container;
});
