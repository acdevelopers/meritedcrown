<?php

namespace App;

use Laracodes\Presenter\Traits\Presentable;
use Spatie\Translatable\HasTranslations;

/**
 * Class Role
 *
 * @package App
 * @author Anitche Chisom
 */
class Role extends \Silber\Bouncer\Database\Role
{
    use HasTranslations, Presentable;

    /**
     * @var array
     */
    public $translatable = ['title'];

    /**
     * @var \App\Presenters\RolePresenter|string
     */
    protected $presenter = 'App\Presenters\RolePresenter';
}
