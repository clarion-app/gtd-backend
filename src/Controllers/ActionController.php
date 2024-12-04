<?php

namespace ClarionApp\GettingThingsDone\Controllers;

use Illuminate\Http\Request;
use ClarionApp\GettingThingsDone\Models\Action;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

/**
 * Controller for managing Actions in the GTD system.
 */
class ActionController extends Controller
{
    /**
     * Display a listing of all actions.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $actions = Action::all();
        return response()->json($actions);
    }

    /**
     * Store a newly created action in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     *
     * @bodyParam title string required The title of the action.
     * @bodyParam description string Optional description of the action.
     * @bodyParam project_id uuid The UUID of the associated project.
     * @bodyParam context_id uuid The UUID of the associated context.
     * @bodyParam due_date date The due date of the action.
     * @bodyParam completed boolean Whether the action is completed.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id'  => 'nullable|uuid|exists:gtd_projects,id',
            'context_id'  => 'nullable|uuid|exists:gtd_contexts,id',
            'due_date'    => 'nullable|date',
            'completed'   => 'nullable|boolean',
        ]);

        $action = Action::create($validatedData);
        return response()->json($action, 201);
    }

    /**
     * Display the specified action.
     *
     * @param  string  $id
     * @return JsonResponse
     *
     * @urlParam id string required The UUID of the action.
     */
    public function show(string $id): JsonResponse
    {
        $action = Action::findOrFail($id);
        return response()->json($action);
    }

    /**
     * Update the specified action in storage.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return JsonResponse
     *
     * @urlParam id string required The UUID of the action.
     * @bodyParam title string The title of the action.
     * @bodyParam description string Optional description of the action.
     * @bodyParam project_id uuid The UUID of the associated project.
     * @bodyParam context_id uuid The UUID of the associated context.
     * @bodyParam due_date date The due date of the action.
     * @bodyParam completed boolean Whether the action is completed.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $action = Action::findOrFail($id);

        $validatedData = $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'project_id'  => 'nullable|uuid|exists:gtd_projects,id',
            'context_id'  => 'nullable|uuid|exists:gtd_contexts,id',
            'due_date'    => 'nullable|date',
            'completed'   => 'nullable|boolean',
        ]);

        $action->update($validatedData);
        return response()->json($action);
    }

    /**
     * Remove the specified action from storage.
     *
     * @param  string  $id
     * @return JsonResponse
     *
     * @urlParam id string required The UUID of the action.
     */
    public function destroy(string $id): JsonResponse
    {
        $action = Action::findOrFail($id);
        $action->delete();
        return response()->json(null, 204);
    }
}
