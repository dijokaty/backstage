<?php declare(strict_types=1);

namespace DJKT\Backstage\Modules\RatingModule;


use DJKT\Backstage\Modules\CommonModule\Rest\RestAdapter;
use DJKT\Backstage\Modules\RatingModule\Model\Ratings;
use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\Statement;

class RatingExtension extends CompilerExtension
{
    public function loadConfiguration()
    {
        $builder = $this->getContainerBuilder();

        $builder->addDefinition($this->prefix('ratings'))
            ->setType(Ratings::class)
            ->setArguments([
                'rest' => new Statement(RestAdapter::class),
            ]);
    }
}