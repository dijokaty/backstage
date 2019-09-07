<?php declare(strict_types=1);

namespace DJKT\Backstage\Modules\RatingModule\Presenters;


use DJKT\Backstage\Modules\RatingModule\Model\Ratings;
use DJKT\Backstage\Modules\TheaterModule\Model\Scenes;
use Nette\Application\UI\Presenter;

class KioskPresenter extends Presenter
{

    /** @var Scenes @inject */
    public $scenes;

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

        $this->template->navScene = $scene;

        $this->template->play = [
            'caption' => 'Kytice',
        ];

        $this->template->ratingOptions = $this->ratings->getRatingValues();
    }

    public function handleRate(int $score)
    {
        $result = $this->ratings->submitRating('5d6d21153b70bd774cf05743', $score);

        if ($result['success']) {
            $this->sendJson([
                'status' => 'success',
                'alert' => 'Děkujeme za váš názor!'
            ]);
        }

        $this->sendJson([
            'status' => 'error',
            'alert' => 'Něco se pokazilo',
        ]);
    }
}