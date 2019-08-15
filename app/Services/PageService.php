<?php

namespace App\Services;


use AcDevelopers\EloquentRepository\BaseService;
use App\Contracts\Repositories\PageRepositoryInterface;
use App\Contracts\Services\PageServiceInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * Class PageService.
 *
 * @package App\Services
 */
class PageService extends BaseService implements PageServiceInterface
{
    /**
     * BookService constructor.
     *
     * @param \App\Contracts\Repositories\PageRepositoryInterface $repository
     */
    public function __construct(PageRepositoryInterface $repository)
    {
        parent::__construct($repository);

        //
    }
}



