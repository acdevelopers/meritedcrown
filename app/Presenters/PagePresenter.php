<?php

namespace App\Presenters;

use Laracodes\Presenter\Presenter;

/**
 * Class PagePresenter
 *
 * @package App\Presenters
 * @author Anitche Chisom
 */
class PagePresenter extends Presenter
{
    public function pageTitle()
    {
        return $this->title;
    }

    public function resourceUrl(string $action = 'show')
    {
        if ($action == 'index') {
            return route('pages.'.$action);
        }

        return route('pages.'.$action, $this->slug);
    }
}