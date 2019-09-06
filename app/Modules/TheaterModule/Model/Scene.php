<?php declare(strict_types=1);

namespace DJKT\Backstage\Modules\TheaterModule\Model;


class Scene
{
    /** @var string */
    private $id;
    /** @var string */
    private $title;

    public function __construct(string $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    /** @return string */
    public function getId(): string
    {
        return $this->id;
    }

    /** @return string */
    public function getTitle(): string
    {
        return $this->title;
    }

}