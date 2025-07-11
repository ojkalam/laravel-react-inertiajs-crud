<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        if (!$user) {
            $user = User::factory()->create();
        }

        return [
            'id' => Str::uuid(),
            'type' => 'App\\Notifications\\NewReviewNotification',
            'notifiable_type' => User::class,
            'notifiable_id' => $user->id,
            'data' => [
                'message' => $this->faker->sentence,
                'link' => $this->faker->url,
            ],
            'read_at' => $this->faker->boolean(70) ? now() : null, // 70% chance of being read
        ];
    }
}
