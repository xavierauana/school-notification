<?php

namespace Anacreation\School\Notification\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class CommunicationChannel extends Model
{
    protected $fillable = [
        'communication_type',
        'communication_id'
    ];

    // Relation
    public function contact(): Relation {
        return $this->belongsTo(Contact::class);
    }

    public function channel(): Relation {
        return $this->morphTo('communication');
    }
}
