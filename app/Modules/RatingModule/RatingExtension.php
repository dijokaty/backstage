<?php declare(strict_types=1);

namespace DJKT\Backstage\Modules\RatingModule;


use DJKT\Backstage\Modules\RatingModule\Model\Ratings;
use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Schema;

class RatingExtension extends CompilerExtension
{
    public function getConfigSchema(): Schema
    {
        return Expect::structure([
            'baseUrl' => Expect::string()->required(),
        ]);
    }

    public function loadConfiguration()
    {
        $builder = $this->getContainerBuilder();
        $config = $this->getConfig();

        $builder->addDefinition($this->prefix('ratings'))
            ->setType(Ratings::class)
            ->setArguments([
                'baseUrl' => $config->baseUrl,
            ]);
    }
}