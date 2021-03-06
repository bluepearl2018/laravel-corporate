<?php

namespace Eutranet\Corporate\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory
 */
class CorporateGeneralTermFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape(['description' => "string", 'title' => "string", 'lead' => "array|string", 'body' => "array|string", 'file_path' => "null", 'admin_id' => "int"])]
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence(15),
            'title' => $this->faker->sentence(10),
            'lead' => $this->faker->paragraphs(1, true),
            'body' => $this->faker->paragraphs(5, true),
            'file_path' => null,
            'admin_id' => 1,
        ];
    }
}
