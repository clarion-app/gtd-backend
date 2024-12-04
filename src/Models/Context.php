<?php

namespace ClarionApp\GettingThingsDone\Models;

use Illuminate\Database\Eloquent\Model;
use ClarionApp\EloquentMultiChainBridge\EloquentMultiChainBridge;

class Context extends Model
{
    use EloquentMultiChainBridge;

    protected $table = 'gtd_contexts';

    protected $fillable = [
        'name',
        'description',
    ];

    public function actions()
    {
        return $this->hasMany(Action::class, 'context_id');
    }
}
