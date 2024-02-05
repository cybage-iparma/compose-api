<?php

namespace Database\Factories;

use App\Models\MappCloudCustomer;
use App\Models\MessageCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MessageCategory>
 */
class MessageCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = MessageCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => MappCloudCustomer::all()->random()->cloud_id,
            'category_name' => fake()->name(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
