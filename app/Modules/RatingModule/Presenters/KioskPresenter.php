<?php declare(strict_types=1);

namespace DJKT\Backstage\Modules\RatingModule\Presenters;


use DJKT\Backstage\Modules\RatingModule\Model\Ratings;
use DJKT\Backstage\Modules\TheaterModule\Model\Plays;
use DJKT\Backstage\Modules\TheaterModule\Model\Scenes;
use Nette\Application\UI\Presenter;

class KioskPresenter extends Presenter
{

    /** @var Scenes @inject */
    public $scenes;

    /** @var Plays @inject */
    public $plays;

    /** @var Ratings @inject */
    public $ratings;

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

        $this->template->play = $this->plays->getPlayForStage($scene->getTitle());

        $this->template->ratingOptions = $this->ratings->getRatingValues();
    }

    public function handleRate(int $score)
    {
        $result = $this->ratings->submitRating('5d6d21153b70bd774cf05743', $score);

        if ($result['success']) {
            $this->sendJson([
                'status' => 'success',
                'alert' => $this->ratings->getFlavourText($score),
            ]);
        }

        $this->sendJson([
            'status' => 'error',
            'alert' => 'Něco se pokazilo',
        ]);
    }
}