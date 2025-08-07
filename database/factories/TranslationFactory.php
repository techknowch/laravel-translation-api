<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Factories\Factory;

class TranslationFactory extends Factory
{
    protected $model = Translation::class;

    public function definition(): array
    {
        $languages = Language::pluck('id')->all();
        return [
            'key' => $this->faker->unique()->word,
            'content' => $this->faker->sentence,
            'original_content' => $this->faker->sentence,
            'from_locale' => 'en',
            'to_locale' => $this->faker->randomElement(['ur', 'fr', 'es']),
            'language_id' => $this->faker->randomElement($languages),
            'tags' => $this->faker->randomElements(['mobile', 'web', 'app'], 1),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}