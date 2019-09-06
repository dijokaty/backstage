<?php declare(strict_types=1);

namespace DJKT\Backstage\Modules\RatingKioskModule\Presenters;


use DJKT\Backstage\Modules\TheaterModule\Model\Scenes;
use Nette\Application\UI\Presenter;

class KioskPresenter extends Presenter
{

    /** @var Scenes @inject */
    public $scenes;

    public function renderListScenes()
    {
        $this->template->scenes = $this->scenes->getScenes();
    }

    public function renderDisplay(string $sceneId)
    {
        $scene = $this->scenes->getScene($sceneId);
        if (!$scene) {
            $this->flashMessage("Scéna $sceneId nebyla nalezena");
            $this->redirect('listScenes');
        }

        $this->template->scene = $scene;

    }
}