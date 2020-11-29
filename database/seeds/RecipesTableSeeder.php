<?php

use Illuminate\Database\Seeder;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Recipe::all()->each->delete();

        $recipes = factory(\App\Models\Recipe::class)->times(10)->create();

        $faker = Faker\Factory::create();
        $tags = \App\Models\Tag::all();

        $recipes->each(function (\App\Models\Recipe $recipe) use ($faker, $tags) {
            $path = DatabaseSeeder::randomMediaPath($faker, 'recipe');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/'.$type.';base64,'.base64_encode($data);

            $recipe->ingredients = [
                [
                    'name'     => 'Chocolat',
                    'quantity' => '250 g',
                ],
                [
                    'name'     => 'Eau',
                    'quantity' => '200 ml',
                ],
                [
                    'name'     => 'Farine',
                    'quantity' => '300 g',
                ],
                [
                    'name'     => 'Sucre',
                    'quantity' => '200 g',
                ],
                [
                    'name'     => 'Noisette',
                    'quantity' => '200 g',
                ],
                [
                    'name'     => 'Oeufs',
                    'quantity' => '3',
                ],
            ];
            $recipe->utensils = [
                [
                    'name' => 'Saladier',
                ],
                [
                    'name' => 'Cuillère en bois',
                ],
                [
                    'name' => 'Bol',
                ],
                [
                    'name' => 'Balance',
                ],
            ];
            $recipe->image = $base64;
            $recipe->save();

            if ($tags) {
                $recipe->tags()->saveMany($tags->random($faker->numberBetween(0, 2)));
            }
        });
    }
}
