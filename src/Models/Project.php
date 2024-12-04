<?php

namespace ClarionApp\GettingThingsDone\Models;

use Illuminate\Database\Eloquent\Model;
use ClarionApp\EloquentMultiChainBridge\EloquentMultiChainBridge;

class Project extends Model
{
    use EloquentMultiChainBridge;

    protected $table = 'gtd_projects';

    protected $fillable = [
        'name',
        'description',
        'parent_project_id',
    ];

    public function parentProject()
    {
        return $this->belongsTo(Project::class, 'parent_project_id');
    }

    public function subProjects()
    {
        return $this->hasMany(Project::class, 'parent_project_id');
    }

    public function actions()
    {
        return $this->hasMany(Action::class, 'project_id');
    }
}
