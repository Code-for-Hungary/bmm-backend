<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Event
 *
 * @property string $id
 * @property string $eventgenerator_id
 * @property string|null $parameters
 * @property object|null $selected_options
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Eventgenerator $eventgenerator
 * @property-read int|null $subscription_count
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventgeneratorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereParameters($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscription> $subscriptions
 * @property-read int|null $subscriptions_count
 * @property int $type
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereType($value)
 * @mixin \Eloquent
 */
class Event extends Model
{
    use HasFactory;
    use HasUuids;

    protected $keyType = 'string';
    protected $hidden = ['created_at', 'updated_at'];
    protected $casts = [
        'selected_options' => 'object',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function eventgenerator()
    {
        return $this->belongsTo(Eventgenerator::class);
    }
}
