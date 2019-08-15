<?php

namespace App\Repositories;


use AcDevelopers\EloquentRepository\BaseRepository;
use AcDevelopers\EloquentRepository\Events\RepositoryEntityCreated;
use AcDevelopers\EloquentRepository\Events\RepositoryEntityUpdated;
use App\Page;
use App\Contracts\Repositories\PageRepositoryInterface;

/**
 * Class PageRepository.
 *
 * @package App\Repositories
 */
class PageRepository extends BaseRepository implements PageRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string|\App\Page
     */
    public function model(): string
    {
        return Page::class;
    }

    /**
     * Find data by id
     *
     * @param $id
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model|Page
     * @throws \AcDevelopers\EloquentRepository\Exceptions\RepositoryException
     */
    public function find($id, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->findBySlug($id, $columns);
        $this->resetModel();

        return $model;
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

        foreach ($attributes as $key => $attribute) {
            if (is_array($attribute)) {
                foreach ($attribute as $key_2 => $item) {
                    $model->setTranslation($key, $key_2, $item);
                }
            }

            $model->{$key} = $attribute;
        }

        $model->created_by = auth()->id();

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

        foreach ($attributes as $key => $attribute) {
            if (is_array($attribute)) {
                foreach ($attribute as $key_2 => $item) {
                    $model->setTranslation($key, $key_2, $item);
                }
            }

            $model->{$key} = $attribute;
        }

        $model->updated_by = auth()->id();

        $model->save();

        $this->resetModel();

        event(new RepositoryEntityUpdated($this, $model));

        return $model;
    }
}