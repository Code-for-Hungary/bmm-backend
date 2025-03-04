<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Eventgenerator
 *
 * @property string $id
 * @property string $name
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|null $event_count
 * @method static \Illuminate\Database\Eloquent\Builder|Eventgenerator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Eventgenerator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Eventgenerator query()
 * @method static \Illuminate\Database\Eloquent\Builder|Eventgenerator whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eventgenerator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eventgenerator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eventgenerator whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eventgenerator whereUpdatedAt($value)
 * @property string|null $description
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Event> $event
 * @method static \Illuminate\Database\Eloquent\Builder|Eventgenerator whereDescription($value)
 * @property string|null $extrainfo
 * @property array|null $options_schema
 * @method static \Illuminate\Database\Eloquent\Builder|Eventgenerator whereExtrainfo($value)
 * @mixin \Eloquent
 */
class Eventgenerator extends Model
{
    use HasFactory;
    use HasUuids;
    protected $casts = [
        'options_schema' => 'array',
    ];

    protected $keyType = 'string';
    protected $hidden = ['created_at', 'updated_at'];

    public function event()
    {
        return $this->hasMany(Event::class);
    }
}
