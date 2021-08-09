<?php

namespace Database\Factories;

use App\Models\Comments;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comments::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content'=>$this->faker->text(400),
            'date_written'=>$this->faker->dateTime(),
            'user_id'=>$this->faker->numberBetween(1,80),
            'post_id'=>$this->faker->numberBetween(1,80),

        ];
    }
}
