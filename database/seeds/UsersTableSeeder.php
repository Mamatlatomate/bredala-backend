<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        \App\User::all()->each->delete();

         factory(\App\User::class)->create(['name' => 'Mathieu', 'email' => 'mathieu15.monnier@gmail.com']);
    }
}

