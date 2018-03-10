<?php
/**
 * Author: Xavier Au
 * Date: 9/3/2018
 * Time: 2:23 PM
 */

namespace Anacreation\School\Notification\traits;


use Anacreation\School\Models\CommunicationChannel;
use Illuminate\Database\Eloquent\Relations\Relation;

trait CommunicationTrait
{
    public function channel(): Relation {
        return $this->morphMany(CommunicationChannel::class, "communication");
    }
}