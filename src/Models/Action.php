<?php

namespace ClarionApp\GettingThingsDone\Models;

use Illuminate\Database\Eloquent\Model;
use ClarionApp\EloquentMultiChainBridge\EloquentMultiChainBridge;

class Action extends Model
{
    use EloquentMultiChainBridge;

    protected $table = 'gtd_actions';

    protected $fillable = [
        'title',
        'description',
        'project_id',
        'context_id',
        'due_date',
        'completed',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function context()
    {
        return $this->belongsTo(Context::class, 'context_id');
    }
}
