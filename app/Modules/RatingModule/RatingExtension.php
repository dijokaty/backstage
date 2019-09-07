<?php declare(strict_types=1);

namespace DJKT\Backstage\Modules\RatingModule;


use DJKT\Backstage\Modules\CommonModule\Rest\RestAdapter;
use DJKT\Backstage\Modules\RatingModule\Model\Ratings;
use GuzzleHttp\Client;
use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\Statement;
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

        $restClient = $builder->addDefinition(null)
            ->setType(Client::class)
            ->setArgument('config', [
                'base_uri' => $config->baseUrl,
            ]);

        $builder->addDefinition($this->prefix('ratings'))
            ->setType(Ratings::class)
            ->setArguments([
                'rest' => new Statement(RestAdapter::class, [$restClient]),
            ]);
    }
}