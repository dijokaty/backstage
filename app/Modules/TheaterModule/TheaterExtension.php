<?php declare(strict_types=1);

namespace DJKT\Backstage\Modules\TheaterModule;


use DJKT\Backstage\Modules\TheaterModule\Model\Scenes;
use Nette\DI\CompilerExtension;
use Nette\Neon\Neon;
use Nette\Schema\Expect;
use Nette\Schema\Schema;

class TheaterExtension extends CompilerExtension
{

    public function getConfigSchema(): Schema
    {
        return Expect::structure([
            'scenes' => Expect::string()->required(),
        ]);
    }

    public function loadConfiguration()
    {
        $builder = $this->getContainerBuilder();
        $config = $this->getConfig();

        $scenes = Neon::decode(file_get_contents($config->scenes));

        $builder->addDefinition($this->prefix('scenes'))
            ->setType(Scenes::class)
            ->setArgument('model', $scenes);

    }
}