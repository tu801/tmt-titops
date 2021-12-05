<?php

use App\Models\Product;
use App\Models\ProductBrand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
            'Acer'
        ];

        foreach ($brands as $item) {
            $chk = \App\Models\ProductBrand::where('name', $item)->first();
            if ( !isset($chk->id) ) \App\Models\ProductBrand::create(['name' => $item]);
        }

        //insert demo product
        $products = [
            0 => [
                'name' => 'Laptop Acer Nitro 5 AN515-52-51LW',
                'price' => 1150,
                'brand' => 'Acer',
                'description' => '- CPU: Intel Core i5-8300H ( 2.3 GHz - 4.0 GHz / 8MB / 4 nhân, 8 luồng )
                - Màn hình: 15.6" IPS ( 1920 x 1080 ) , không cảm ứng
                - RAM: 1 x 8GB DDR4 2666MHz
                - Đồ họa: Intel UHD Graphics 630 / NVIDIA GeForce GTX 1050Ti 4GB GDDR5
                - Lưu trữ: 128GB SSD M.2 SATA / 1TB HDD 5400RPM
                - Hệ điều hành: Linux
                - Pin: 4 cell 48 Wh Pin liền , khối lượng: 2.4 kg',
                'images' => 'https://lh3.googleusercontent.com/kVwoMSIS5sIVfQPdhTL9uqQ69S0EuGlYqtaui_uKkHdqyjL_taudJe_jZRqDfQYZpWWlWrrDzv2CTdjlgVc=w500-rw'
            ],
            1 => [
                'name' => 'Laptop ASUS Zenbook UX363EA- HP130T',
                'price' => 1250,
                'brand' => 'Asus',
                'description' => '- CPU: Intel Core i5-1135G7
                - Màn hình: 13.3" OLED (1920 x 1080)
                - RAM: 1 x 8GB LPDDR4X 4266MHz
                - Đồ họa: Intel Iris Xe Graphics
                - Lưu trữ: 512GB SSD M.2 NVMe /
                - Hệ điều hành: Windows 10 Home 64-bit
                - Pin: 4 cell 67 Wh Pin liền
                - Khối lượng: 1.3 kg
                - ChuẩnIntel EVO',
                'images' => 'https://lh3.googleusercontent.com/Fuq0U3tS6kLgZ1B0aMlLuHkxsXvaztB3kl8WFzmFQ2n1wbxiGDOtm9IfTlF1k2QnnLOJdf7E-a_515Lf2rxM4fxfAI6OOnsW=w1000-rw'
            ],
            2 => [
                'name' => 'Laptop Dell Vostro 14 3405 V4R53500U001W',
                'price' => 850,
                'brand' => 'Dell',
                'description' => '- CPU: AMD Ryzen 5 3500U
                - Màn hình: 14" WVA (1920 x 1080)
                - RAM: 1 x 4GB DDR4 2400MHz
                - Đồ họa: AMD Radeon Vega 8 Graphics
                - Lưu trữ: 256GB SSD M.2 NVMe /
                - Hệ điều hành: Windows 10 Home SL 64-bit
                - Pin: 3 cell 42 Wh Pin liền
                - Khối lượng: 1.7 kg',
                'images' => 'https://lh3.googleusercontent.com/TCZ493jSOufUU3CcfuRyoKOV2CyUwLlEPLy1WRf-FefFxu8VC0wlj9mZ8tYxSOJaJc_mLzUH9frCiUMClGV2B5CTVb6xOrix=w1000-rw'
            ],
            3 => [
                'name' => 'Laptop HP OMEN 16-b0141TX 4Y0Z7PA',
                'price' => 2200,
                'brand' => 'HP',
                'description' => '- CPU: Intel Core i5-11400H
                - Màn hình: 16" IPS (1920 x 1080), 144Hz
                - RAM: 2 x 8GB DDR4 2933MHz
                - Đồ họa: NVIDIA GeForce RTX 3060 6GB GDDR6 / Intel UHD Graphics
                - Lưu trữ: 1TB SSD M.2 NVMe /
                - Hệ điều hành: Windows 10 Home 64-bit
                - Pin: 6 cell 83 Wh Pin liền
                - Khối lượng: 2.3 kg',
                'images' => 'https://lh3.googleusercontent.com/3DE7J74t62fCZdEUAA92MPFD10gw9xT97R-V761mnGyZbT6qtRAjrPpg3LQg3ZrXUkHWaAg0fY_lXEVzYtSkdbi7yZisPzM=w1000-rw'
            ],
        ];

        foreach ( $products as $item ) {
            $chkProduct = Product::where('name', $item['name'])->first();
            if ( !isset($chkProduct->id) ) {
                //get brands
                $brand = ProductBrand::where('name', $item['brand'])->first();
                $brand_id = $brand->id ?? random_int(1,6);
                $item['brand_id'] = $brand_id;

                //get image
                $imgName = time().'-'.$this->slugify($item['name']).'.webp';
                $contents = file_get_contents($item['images']);
                Storage::put('public/uploads/products/'.$imgName, $contents);
                $item['images'] = $imgName;
                unset($item['brand']);

                Product::create($item);
            }
        }
    }


    public function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
