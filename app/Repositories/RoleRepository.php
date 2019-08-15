<?php

namespace App\Repositories;


use AcDevelopers\EloquentRepository\BaseRepository;
use AcDevelopers\EloquentRepository\Events\RepositoryEntityCreated;
use AcDevelopers\EloquentRepository\Events\RepositoryEntityUpdated;
use App\Role;
use App\Contracts\Repositories\RoleRepositoryInterface;

/**
 * Class RoleRepository.
 *
 * @package App\Repositories
 */
class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string|\App\Role
     */
    public function model(): string
    {
        return Role::class;
    }

    /**
     * Save a new role in repository
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|\App\Role|mixed
     * @throws \AcDevelopers\EloquentRepository\Exceptions\RepositoryException
     */
    public function create(array $attributes)
    {
        $model = $this->makeModel();

        $model->setTranslation('title', 'en', $attributes['title']['en']);
        $model->setTranslation('title', 'fr', $attributes['title']['fr']);
        $model->name = $attributes['name'];
        $model->level = $attributes['level'];

        $model->save();

        $this->resetModel();

        event(new RepositoryEntityCreated($this, $model));

        return $model;
    }

    /**
     * Update a entity in repository by id
     *
     * @param $id
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|\App\Role
     * @throws \AcDevelopers\EloquentRepository\Exceptions\RepositoryException
     */
    public function update($id, array $attributes)
    {
        $model = $this->find($id);

        $model->setTranslation('title', 'en', $attributes['title']['en']);
        $model->setTranslation('title', 'fr', $attributes['title']['fr']);
        $model->name = $attributes['name'];
        $model->level = $attributes['level'];

        $model->save();

        $this->resetModel();

        event(new RepositoryEntityUpdated($this, $model));

        return $model;
    }
}