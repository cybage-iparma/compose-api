<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\MessageTag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MessageTag>
 */
class MessageTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = MessageTag::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'message_id' => Message::all()->random()->message_id,
            'tag_name' => fake()->name(),
            'created_at' => now()
        ];
    }
}
