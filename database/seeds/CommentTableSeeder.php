<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
		DB::table('comments')->insert([
            'author' => str_random(10),
            'text' => str_random(50),
        ]);
    }
}
