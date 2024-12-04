<?php

namespace ClarionApp\GettingThingsDone\Controllers;

use Illuminate\Http\Request;
use ClarionApp\GettingThingsDone\Models\Context;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

/**
 * Controller for managing Contexts in the GTD system.
 */
class ContextController extends Controller
{
    /**
     * Display a listing of all contexts.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $contexts = Context::all();
        return response()->json($contexts);
    }

    /**
     * Store a newly created context in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     *
     * @bodyParam name string required The name of the context.
     * @bodyParam description string Optional description of the context.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $context = Context::create($validatedData);
        return response()->json($context, 201);
    }

    /**
     * Display the specified context.
     *
     * @param  string  $id
     * @return JsonResponse
     *
     * @urlParam id string required The UUID of the context.
     */
    public function show(string $id): JsonResponse
    {
        $context = Context::findOrFail($id);
        return response()->json($context);
    }

    /**
     * Update the specified context in storage.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return JsonResponse
     *
     * @urlParam id string required The UUID of the context.
     * @bodyParam name string The name of the context.
     * @bodyParam description string Optional description of the context.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $context = Context::findOrFail($id);

        $validatedData = $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $context->update($validatedData);
        return response()->json($context);
    }

    /**
     * Remove the specified context from storage.
     *
     * @param  string  $id
     * @return JsonResponse
     *
     * @urlParam id string required The UUID of the context.
     */
    public function destroy(string $id): JsonResponse
    {
        $context = Context::findOrFail($id);
        $context->delete();
        return response()->json(null, 204);
    }
}
