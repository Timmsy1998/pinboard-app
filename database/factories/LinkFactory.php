<?php

namespace Database\Factories;

use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Link>
 */
class LinkFactory extends Factory
{
    protected $model = Link::class;

    public function definition()
    {
        return [
            'url' => $this->faker->url,
            'title' => $this->faker->sentence,
            'comments' => $this->faker->paragraph,
            'tags' => 'laravel vue',
            'is_valid' => true,
        ];
    }
}
