<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $icon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Room> $rooms
 * @property-read int|null $rooms_count
 * @method static \Database\Factories\AmenityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Amenity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Amenity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Amenity query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Amenity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Amenity whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Amenity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Amenity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Amenity whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Amenity extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'icon',
    ];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_amenities', 'amenity_id', 'room_id');
    }
}
