<?php

namespace App\Http\Controllers;

use AcDevelopers\EloquentRepository\Exceptions\RepositoryException;
use App\Contracts\Services\PageServiceInterface;
use App\Http\Requests\PageRequest as Request;
use App\Page;

/**
 * Class PageController.
 *
 * @package App\Http\Controllers
 */
class PageController extends Controller
{
    /**
     * @var PageServiceInterface
     */
    protected $service;

    /**
     * PageController constructor.
     * @param PageServiceInterface $service
     */
    public function __construct(PageServiceInterface $service)
    {
        $this->middleware(['auth'])->except(['show']);
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
        $this->authorize('viewAny', Page::class);

        try {
            $nodes = $this->service->getRepository()->paginate();

            return view('pages.page.index')->with([
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
        $this->authorize('create', Page::class);

        return view('pages.page.form');
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
            $this->authorize('create', Page::class);

            $node = $this->service->getRepository()->create($request->validated());

            flash()->success($node->title . " created successfully");

            return redirect($node->present()->resourceUrl);

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

            return view('pages.page.show')->with(['node' => $node]);

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

            return view('pages.page.form')->with([
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

            $message = 'Page deleted.';

            if (\request()->wantsJson()) {
                return response([
                    'message' => $message,
                    'redirect' => route('pages.index')
                ]);
            }

            return redirect()->route('pages.index');

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
