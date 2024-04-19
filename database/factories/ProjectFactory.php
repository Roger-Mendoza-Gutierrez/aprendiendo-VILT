<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $colorName = fake()->randomElement(Project::getAvailableTextColor());
        $iconeName = fake()->randomElement(Project::getAvailableIcons());
        return [
            'title' => fake()->unique()->word(2, true),
            'description' => fake()->sentence(),
            'color' => $colorName,
            'icon_name' => $iconeName,
        ];
    }
}
