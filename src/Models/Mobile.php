<?php

namespace Anacreation\School\Notification\Models;

use Anacreation\School\Notification\Contracts\CommunicationTypeInterface;
use Anacreation\School\Notification\traits\CommunicationTrait;
use Illuminate\Database\Eloquent\Model;

class Mobile extends Model implements CommunicationTypeInterface
{
    use CommunicationTrait;

    public function getFullNumberAttribute(): string {
        return $this->country_code . $this->number;
    }
}
