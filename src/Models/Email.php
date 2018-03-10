<?php

namespace Anacreation\School\Notification\Models;

use Anacreation\School\Notification\Contracts\CommunicationTypeInterface;
use Anacreation\School\Notification\traits\CommunicationTrait;
use Illuminate\Database\Eloquent\Model;

class Email extends Model implements CommunicationTypeInterface
{
    use CommunicationTrait;

    protected $fillable = [
        'address'
    ];

}
