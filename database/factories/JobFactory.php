<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $tags = [
            'PHP',
            'JavaScript',
            'Python',
            'Java',
            'C#',
            'Ruby',
            'HTML',
            'CSS',
            'React',
            'Angular',
            'Vue.js',
            'Laravel',
            'Symfony',
            'Node.js',
            'Express.js',
            'Django',
            'Flask',
            'Spring',
            'ASP.NET',
            'Ruby on Rails',
        ];
        
            $randomTags = [];

            for ($i = 0; $i < 3; $i++) {
                $randomTags[] = $this->faker->randomElement($tags);
            }
        
        return [
            'user_id' => 3,
            'title'=>$this->faker->sentence(),
            'tags'=> $randomTags,
            'company'=>$this->faker->company(),
            'email'=>$this->faker->companyEmail(),
            'website'=>$this->faker->url(),
            'location'=>$this->faker->city(),
            'description'=>$this->faker->paragraph(5),
            'photo_path' => 'public/images/ifvdlJXIxVAYs2asiBzQCphMCkGoyfu4UR3OEble.png',


        ];
    }
}
