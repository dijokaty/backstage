<?php declare(strict_types=1);

namespace DJKT\Backstage\Modules\RatingModule\Model;


class Ratings
{
    /** @var string */
    private $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }
    
    public function getRatingValues()
    {
        return [
            1, 2, 3, 4, 5
        ];
    }
}