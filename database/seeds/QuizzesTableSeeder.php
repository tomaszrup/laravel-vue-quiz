<?php

use Illuminate\Database\Seeder;

class QuizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      {
        factory(App\Quiz::class, 5)->create()->each(function ($quiz) {
          foreach (range(1, 10) as $num) {
            $quiz->questions()->save(factory(App\Question::class)->make());
          }
        });
      }
    }
}
