<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=> $this->faker->word(),
            'content'=>$this->faker->text(400),
            'date_written'=>$this->faker->dateTime(),
            'user_id'=>$this->faker->numberBetween(1 , 50),
            'Category_id'=>$this->faker->numberBetween(1 , 50),
            'featured_image'=>$this->faker->imageUrl(),
            'vote_up'=>$this->faker->numberBetween(1,100),
            'vote_down'=>$this->faker->numberBetween(1,100),


        ];
    }
}
