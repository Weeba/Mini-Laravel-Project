<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        Question::truncate();
        foreach(range(1, 30) as $index) {
            Question::create([
                'user_id' => $faker->numberBetween($min=1, $max=3),
                'body' =>     $faker->sentence, 
                'upvote' =>   0,
                'category_id' => $faker->numberBetween($min=1, $max=3),
                'answer' => 0
                ]);
        }
    }
}
