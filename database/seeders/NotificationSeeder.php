<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::first();

        if ($user) {
            // Create one notification specifically for the first user
            Notification::factory()->create([
                'notifiable_id' => $user->id,
                'notifiable_type' => \App\Models\User::class,
            ]);

            // Create remaining notifications for random users
            Notification::factory()->count(9)->create();
        } else {
            // If no users exist, just create 10 notifications for random users (which will create users)
            Notification::factory()->count(10)->create();
        }
    }
}
