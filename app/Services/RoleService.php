<?php

namespace App\Services;


use AcDevelopers\EloquentRepository\BaseService;
use App\Contracts\Repositories\RoleRepositoryInterface;
use App\Contracts\Services\RoleServiceInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * Class RoleService.
 *
 * @package App\Services
 * @author Anitche Chisom
 */
class RoleService extends BaseService implements RoleServiceInterface
{
    /**
     * BookService constructor.
     *
     * @param RoleRepositoryInterface $repository
     */
    public function __construct(RoleRepositoryInterface $repository)
    {
        parent::__construct($repository);

    }
}