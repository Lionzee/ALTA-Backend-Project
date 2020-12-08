<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\ProductCategory;

use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i=1;$i<=20;$i++){
            $product =Product::create([
                'category_id' => ProductCategory::all()->random()->id,
                'name' => $faker->words($nb = rand(3,8), $asText = true) ,
                'description' => $faker->paragraph($nbSentences = rand(3,6), $variableNbSentences = true),
                'price' => $faker->randomNumber(5),
                'stock' => $faker->randomNumber(3),
            ]);
        }
    }
}
