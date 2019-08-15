<?php

namespace App\Presenters;

use Laracodes\Presenter\Presenter;

/**
 * Class RolePresenter
 *
 * @package App\Presenters
 * @author Anitche Chisom
 */
class RolePresenter extends Presenter
{
    public function pageTitle()
    {
        return $this->title;
    }

    public function resourceUrl(string $action = 'show')
    {
        if ($action == 'index') {
            return route('roles.'.$action);
        }

        return route('roles.'.$action, $this->id);
    }
}