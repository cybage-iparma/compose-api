<?php

namespace Database\Factories;

use App\Models\MappCloudCustomer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MappCloudCustomer>
 */
class MappCloudCustomerFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = MappCloudCustomer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => fake()->name(),
            'contact_name' => fake()->name(),
            'contact_email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->unique()->phoneNumber(),
            'industry' => fake()->name(),
            'address_line1' => fake()->address(),
            'address_line2' => fake()->address(),
            'city' => fake()->city(),
            'state_province' => fake()->name(),
            'postal_code' => fake()->postcode(),
            'country' => fake()->country(),
            'reseller_id' => 1,
            'sales_id' => 1,
            'financial_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
