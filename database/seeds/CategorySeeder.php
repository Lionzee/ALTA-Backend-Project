<?php

use Illuminate\Database\Seeder;
use App\ProductCategory;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCategory::create(
            [
                'name' => 'Buku'
            ]
        );

        ProductCategory::create(
            [
                'name' => 'Elektronik'
            ]
        );

        ProductCategory::create(
            [
                'name' => 'Olahraga'
            ]
        );

        ProductCategory::create(
            [
                'name' => 'Fashion Pria'
            ]
        );

        ProductCategory::create(
            [
                'name' => 'Fashion Wanita'
            ]
        );
    }
}
