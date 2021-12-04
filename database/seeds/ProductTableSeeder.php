<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add brands
        $brands = [
            'Dell',
            'HP',
            'Asus',
            'MSI',
            'Apple',
        ];

        foreach ($brands as $item) {
            $chk = \App\Models\ProductBrand::where('name', $item)->first();
            if ( !isset($chk->id) ) \App\Models\ProductBrand::create(['name' => $item]);
        }
    }
}
