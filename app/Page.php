<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Laracodes\Presenter\Traits\Presentable;
use Spatie\Translatable\HasTranslations;

/**
 * Class Page.
 *
 * @package App
 * @author Anitche Chisom
 */
class Page extends Model
{
    use Sluggable, SluggableScopeHelpers, HasTranslations, Presentable;

    /**
     * @var array
     */
    public $translatable = ['title', 'body'];

    /**
     * @var \App\Presenters\RolePresenter|string
     */
    protected $presenter = 'App\Presenters\PagePresenter';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published' => 'boolean',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getIsPublishedAttribute()
    {
        return $this->published ? 'Yes' : 'No';
    }
}
