<?php

namespace TypiCMS\Modules\Projects\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Categories\Shells\Models\Category;
use TypiCMS\Modules\Core\Shells\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Projects\Shells\Http\Requests\FormRequest;
use TypiCMS\Modules\Projects\Shells\Models\Project;
use TypiCMS\Modules\Projects\Shells\Repositories\ProjectInterface;

class AdminController extends BaseAdminController
{
    public function __construct(ProjectInterface $project)
    {
        parent::__construct($project);
    }

    /**
     * List models.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::all([], true);
        app('JavaScript')->put('options.categories', $categories);

        return view('projects::admin.index');
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->getModel();

        return view('projects::admin.create')
            ->with(compact('model'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Projects\Shells\Models\Project $project
     *
     * @return \Illuminate\View\View
     */
    public function edit(Project $project)
    {
        return view('projects::admin.edit')
            ->with([
                'model' => $project,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Projects\Shells\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $project = $this->repository->create($request->all());

        return $this->redirect($request, $project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Projects\Shells\Models\Project            $model
     * @param \TypiCMS\Modules\Projects\Shells\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Project $project, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $project);
    }
}
