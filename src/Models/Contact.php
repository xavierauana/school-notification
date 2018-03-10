<?php

namespace Anacreation\School\Notification\Models;

use Anacreation\School\Notification\Contracts\CommunicationTypeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class Contact extends Model
{
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
    ];

    // Relation
    public function channels(): Relation {
        return $this->hasMany(CommunicationChannel::class);
    }

    public function addChannel(CommunicationTypeInterface $channel) {
        $this->channels()->create([
            'communication_id'   => $channel->id,
            'communication_type' => get_class($channel),
        ]);
    }

    public function removeChannel(CommunicationTypeInterface $channel) {
        $this->channels()->where([
            ['communication_id', '=', $channel->id],
            ['communication_type', '=', get_class($channel)],
        ])->delete();
    }

    public function getEmails(): Collection {
        return $this->get('email');
    }

    public function get(string $channel): Collection {
        $registeredChannels = config("school_notification.channels");
        if (in_array($channel, array_keys($registeredChannels))) {
            return $this->channels()
                        ->whereCommunicationType($registeredChannels [$channel])
                        ->get()->map->channel;
        }
        throw new \InvalidArgumentException("Invalid channel");
    }

    public function __call($method, $parameters) {

        if (!method_exists($this, $method)) {
            $fistThreeChars = substr($method, 0, 3);
            if ($fistThreeChars === "get") {
                $channels = array_keys(config("school_notification.channels"));
                $singular = str_singular(substr($method, 3,
                    count_chars($method) - 1));
                if (in_array($singular, $channels)) {

                }
            }
        }

        return parent::__call($method,
            $parameters); // TODO: Change the autogenerated stub
    }

    // Accessor
    public function getFullNameAttribute(): string {
        return "{$this->first_name} {$this->last_name}";
    }
}
