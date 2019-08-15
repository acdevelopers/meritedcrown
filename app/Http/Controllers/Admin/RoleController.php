<?php

namespace App\Http\Controllers\Admin;

use AcDevelopers\EloquentRepository\Exceptions\RepositoryException;
use App\Contracts\Services\RoleServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest as Request;
use App\Role;

/**
 * Class RoleController
 *
 * @package App\Http\Controllers\Admin
 * @author Anitche Chisom
 */
class RoleController extends Controller
{
    /**
     * @var RoleServiceInterface
     */
    protected $service;

    /**
     * RoleController constructor.
     * @param RoleServiceInterface $service
     */
    public function __construct(RoleServiceInterface $service)
    {
        $this->middleware(['auth']);
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);

        try {
            $nodes = $this->service->getRepository()->paginate();

            return view('pages.role.index')->with([
                'nodes' => $nodes
            ]);

        } catch (RepositoryException $exception) {

            flash()->error("{$exception->getMessage()} ({$exception->getCode()}).");

            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Role::class);

        return view('pages.role.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        try {
            $this->authorize('create', Role::class);

            $node = $this->service->getRepository()->create($request->validated());

            flash()->success($node->title . " created successfully");

            return redirect()->route('roles.show', $node);

        } catch (RepositoryException $exception) {

            flash()->error("{$exception->getMessage()} ({$exception->getCode()}).");

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        try {
            $node = $this->service->getRepository()->find($id);

            $this->authorize('view', $node);

            return view('pages.role.show')->with(['node' => $node]);

        } catch (RepositoryException $exception) {

            $message = "{$exception->getMessage()} ({$exception->getCode()}).";

            flash()->error();

            return redirect()->back()->withErrors($message);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        try {
            $node = $this->service->getRepository()->find($id);

            $this->authorize('update', $node);

            return view('pages.role.form')->with([
                'node' => $node
            ]);

        } catch (RepositoryException $exception) {

            $message = "{$exception->getMessage()} ({$exception->getCode()}).";

            flash()->error();

            return redirect()->back()->withErrors($message);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
        try {
            $node = $this->service->getRepository()->find($id);

            $this->authorize('update', $node);

            $node = $this->service->getRepository()->update($node, $request->validated());

            flash()->success($node->title . " updated successfully");

            return back();

        } catch (RepositoryException $exception) {

            flash()->error("{$exception->getMessage()} ({$exception->getCode()}).");

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        try {
            $node = $this->service->getRepository()->find($id);

            $this->authorize('delete', $node);

            $this->service->getRepository()->delete($node);

            $message = 'Role deleted.';

            if (\request()->wantsJson()) {
                return response([
                    'message' => $message,
                    'redirect' => route('roles.index')
                ]);
            }

            return redirect()->route('roles.index');

        } catch (RepositoryException $exception) {

            $message = "{$exception->getMessage()} ({$exception->getCode()}).";

            if (\request()->wantsJson()) {
                return response([
                    'message' => $message,
                ]);
            }

            flash()->error($message);

            return redirect()->back();
        }
    }
}
