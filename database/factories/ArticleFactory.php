<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;
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
            'user_id' => User::inRandomOrder()->first()->id, 
        ];
    }
}
