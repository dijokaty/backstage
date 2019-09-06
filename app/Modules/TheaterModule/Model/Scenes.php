<?php declare(strict_types=1);

namespace DJKT\Backstage\Modules\TheaterModule\Model;


class Scenes
{
    /** @var array */
    private $model;

    public function __construct(array $model)
    {
        $this->model = $model;
    }

    /** @return Scene[] */
    public function getScenes(): array
    {
        $scenes = [];
        foreach ($this->model as $id => $item) {
            $scenes[] = new Scene($id, $item['title']);
        }

        return $scenes;
    }

    public function getScene(string $sceneId): ?Scene
    {
        if (!array_key_exists($sceneId, $this->model)) {
            return null;
        }

        return new Scene($sceneId, $this->model[$sceneId]['title']);
    }
}