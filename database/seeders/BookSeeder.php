<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for($i = 0; $i <10; $i++){
            Book::create([
                'title' => $faker->sentence,
                'author' => $faker->name,
                'publish' => $faker->date,
            ]);
        }
    }
}
