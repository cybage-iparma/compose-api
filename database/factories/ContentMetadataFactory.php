<?php

namespace Database\Factories;

use App\Models\ContentMetadata;
use App\Models\MappCloudCustomer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContentMetadata>
 */
class ContentMetadataFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = ContentMetadata::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => MappCloudCustomer::all()->random()->cloud_id,
            'element_type' => fake()->name(),
            'content_url' => fake()->imageUrl(),
            'content_name' => fake()->name(),
            'is_text' => fake()->boolean(),
            'is_image' => fake()->boolean(),
            'file_name' => fake()->name(),
            'is_public_visible' => fake()->boolean(),
            'is_editable' => fake()->boolean(),
            'description' => fake()->text(),
            'file_size' => 1057149,
            'content_width' => 800,
            'content_height' => 600,
            'mime_type' => fake()->randomElement(['image/jpeg', 'image/png', 'video/mp4', 'audio/mpeg']),
            'expiration_automatic' => fake()->boolean(),
            'expiration_days' => 144,
            'created_at' => fake()->date('Y-m-d h:m:s'),
            'expiration_at' => fake()->date('Y-m-d h:m:s')
        ];
    }
}
