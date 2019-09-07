<?php declare(strict_types=1);

namespace DJKT\Backstage\Modules\RatingModule\Model;


use DJKT\Backstage\Modules\CommonModule\Rest\RestAdapter;

class Ratings
{
    /** @var string */
    private $client;

    public function __construct(RestAdapter $rest)
    {
        $this->client = $rest;
    }

    public function getRatingValues()
    {
        return [
            1, 2, 3, 4, 5
        ];
    }

    public function submitRating(string $playId, int $ratingValue)
    {
        $result = $this->client->post('ratings', [
            'json' => [
                'playId' => $playId,
                'value' => $ratingValue,
            ],
        ]);

        return [
            'success' => !!$result['id'],
            'result' => $result,
        ];
    }
}