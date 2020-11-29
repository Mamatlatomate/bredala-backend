<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(RecipesTableSeeder::class);
    }

    public static function randomMediaPath($faker, $type, $extension = 'jpg'): string
    {
        $types = [
            'recipe' => 7,
        ];

        $i = str_pad($faker->numberBetween(1, $types[$type]), 2, '0', STR_PAD_LEFT);

        return database_path("seeds/media/{$type}-{$i}.{$extension}");
    }
}
