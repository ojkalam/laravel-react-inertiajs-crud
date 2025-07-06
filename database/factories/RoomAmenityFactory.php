<?php

namespace Database\Factories;

use App\Models\RoomAmenity;
use App\Models\Room;
use App\Models\Amenity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomAmenity>
 */
class RoomAmenityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RoomAmenity::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_id' => Room::factory(),
            'amenity_id' => Amenity::factory(),
        ];
    }

    /**
     * Create a room amenity for specific room and amenity.
     */
    public function forRoomAndAmenity(Room $room, Amenity $amenity): static
    {
        return $this->state(fn (array $attributes) => [
            'room_id' => $room->id,
            'amenity_id' => $amenity->id,
        ]);
    }
}