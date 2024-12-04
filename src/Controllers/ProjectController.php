<?php

namespace ClarionApp\GettingThingsDone\Controllers;

use Illuminate\Http\Request;
use ClarionApp\GettingThingsDone\Models\Project;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

/**
 * Controller for managing Projects in the GTD system.
 */
class ProjectController extends Controller
{
    /**
     * Display a listing of all projects.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    /**
     * Store a newly created project in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     *
     * @bodyParam name string required The name of the project.
     * @bodyParam description string Optional description of the project.
     * @bodyParam parent_project_id uuid The UUID of the parent project.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'nullable|string',
            'parent_project_id' => 'nullable|uuid|exists:gtd_projects,id',
        ]);

        $project = Project::create($validatedData);
        return response()->json($project, 201);
    }

    /**
     * Display the specified project.
     *
     * @param  string  $id
     * @return JsonResponse
     *
     * @urlParam id string required The UUID of the project.
     */
    public function show(string $id): JsonResponse
    {
        $project = Project::findOrFail($id);
        return response()->json($project);
    }

    /**
     * Update the specified project in storage.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return JsonResponse
     *
     * @urlParam id string required The UUID of the project.
     * @bodyParam name string The name of the project.
     * @bodyParam description string Optional description of the project.
     * @bodyParam parent_project_id uuid The UUID of the parent project.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $project = Project::findOrFail($id);

        $validatedData = $request->validate([
            'name'              => 'sometimes|required|string|max:255',
            'description'       => 'nullable|string',
            'parent_project_id' => 'nullable|uuid|exists:gtd_projects,id',
        ]);

        $project->update($validatedData);
        return response()->json($project);
    }

    /**
     * Remove the specified project from storage.
     *
     * @param  string  $id
     * @return JsonResponse
     *
     * @urlParam id string required The UUID of the project.
     */
    public function destroy(string $id): JsonResponse
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json(null, 204);
    }
}
