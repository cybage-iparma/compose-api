<?php

namespace Database\Seeders;

use App\Models\MessageCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MessageCategory::factory()
            ->count(1)
            ->create();
    }
}
