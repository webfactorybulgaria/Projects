<?php

namespace TypiCMS\Modules\Projects\Http\Controllers;

use Illuminate\Support\Facades\Request;
use TypiCMS\Modules\Core\Shells\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Projects\Shells\Models\Project;
use TypiCMS\Modules\Projects\Shells\Repositories\ProjectInterface as Repository;

class ApiController extends BaseApiController
{
    public function __construct(Repository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * List resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($builder = null)
    {
        $builder = $this->repository->getModel()->with('category');

        return parent::index($builder);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $model = $this->repository->create(Request::all());
        $error = $model ? false : true;

        return response()->json([
            'error' => $error,
            'model' => $model,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $model
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $updated = $this->repository->update(Request::all());

        return response()->json([
            'error' => !$updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \TypiCMS\Modules\Projects\Shells\Models\Project $project
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Project $project)
    {
        $deleted = $this->repository->delete($project);

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
