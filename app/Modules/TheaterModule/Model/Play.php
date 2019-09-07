<?php declare(strict_types=1);

namespace DJKT\Backstage\Modules\TheaterModule\Model;


class Play
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getId(): string
    {
        return $this->data['_id'];
    }

    public function getTitle(): string
    {
        return $this->data['title'];
    }
}