<?php declare(strict_types=1);


namespace DJKT\Backstage\Modules\TheaterModule\Model;


use DJKT\Backstage\Modules\CommonModule\Rest\RestAdapter;

class Plays
{
    /** @var RestAdapter */
    private $adapter;

    public function __construct(RestAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function getPlayForStage(string $stageId, \DateTime $time = null): ?Play
    {
        $result = $this->adapter->get('stages/' . $stageId, [
            'query' => [
                'time' => $time ?: new \DateTime(),
            ],
        ]);

        return new Play($result[0]);
    }
}