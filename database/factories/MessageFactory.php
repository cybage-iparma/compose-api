<?php

namespace Database\Factories;

use App\Models\MappCloudCustomer;
use App\Models\Message;
use App\Models\MessageCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => MappCloudCustomer::all()->random()->cloud_id,
            'message_category_id' => MessageCategory::all()->random()->message_category_id,
            'message_name' => fake()->name(),
            'subject' => fake()->name(),
            'sender_address' => fake()->address(),
            'sender_name' => fake()->name(),
            'status' => fake()->name(),
            'created_at' => now()
        ];
    }
}
