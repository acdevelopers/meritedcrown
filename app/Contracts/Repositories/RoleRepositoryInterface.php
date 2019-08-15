<?php

namespace App\Contracts\Repositories;

use AcDevelopers\EloquentRepository\Contracts\RepositoryInterface;

/**
 * Interface RoleRepositoryInterface.
 *
 * @package App\Contracts\Repositories
 */
interface RoleRepositoryInterface extends RepositoryInterface
{
    /**
     * Save a new role in repository
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \AcDevelopers\EloquentRepository\Exceptions\RepositoryException
     */
    public function create(array $attributes);
}