<?php

use Illuminate\Support\Facades\Route;
use ClarionApp\GettingThingsDone\Controllers\ActionController;
use ClarionApp\GettingThingsDone\Controllers\ProjectController;
use ClarionApp\GettingThingsDone\Controllers\ContextController;

Route::group(['middleware'=>['auth:api'], 'prefix'=>'api/clarion-app/gtd' ], function () {
    Route::apiResource('actions', ActionController::class);
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('contexts', ContextController::class);
});
