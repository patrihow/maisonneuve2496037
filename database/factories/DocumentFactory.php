<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Document;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    protected $model = Document::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title_en' => $this->faker->sentence(),
            'title_fr' => $this->faker->sentence(),
            'content_en' => $this->faker->paragraph(),
            'content_fr' => $this->faker->paragraph(),
            'file_path' => $this->faker->url(),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
