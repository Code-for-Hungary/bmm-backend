<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Subscription
 *
 * @property string $id
 * @property string $email
 * @property int $active
 * @property string $event_id
 * @property int $confirmed
 * @property string|null $confirmation_start
 * @property string|null $confirmation_date
 * @property string|null $unsubscribe_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Event $event
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereConfirmationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereConfirmationStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereUnsubscribeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Subscription extends Model
{
    use HasFactory;
    use HasUuids;

    protected $keyType = 'string';
    protected $hidden = ['created_at', 'updated_at'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function confirm()
    {
        $this->active = true;
        $this->confirmed = true;
        $this->confirmation_date = Carbon::now();
    }
}
