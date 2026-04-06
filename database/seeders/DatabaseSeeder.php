<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── USERS ──────────────────────────────────────────────────────────────
        User::create(['name'=>'Admin Utama',   'email'=>'admin@ukk.com', 'password'=>Hash::make('password'),'role'=>'admin', 'is_active'=>true]);
        User::create(['name'=>'Alex Rivera',   'email'=>'staff@ukk.com', 'password'=>Hash::make('password'),'role'=>'staff', 'is_active'=>true]);
        User::create(['name'=>'Budi Santoso',  'email'=>'user@ukk.com',  'password'=>Hash::make('password'),'role'=>'user',  'phone'=>'+62 812 3456 7890','address'=>'Jl. Sudirman No. 123, Jakarta Pusat','is_active'=>true]);

        // ── PRODUCTS ───────────────────────────────────────────────────────────
        $products = [
            ['name'=>'Elite Watch Pro',            'category'=>'Elektronik',    'price'=>3_909_300,  'stock'=>25,  'sku'=>'EWP-001'],
            ['name'=>'Studio Headphones',           'category'=>'Elektronik',    'price'=>6_268_300,  'stock'=>40,  'sku'=>'SH-001'],
            ['name'=>'Nordic Lounge Chair',         'category'=>'Rumah & Taman', 'price'=>13_345_000, 'stock'=>12,  'sku'=>'NLC-001'],
            ['name'=>'Ceramic Vessel Set',          'category'=>'Rumah & Taman', 'price'=>1_884_000,  'stock'=>30,  'sku'=>'CVS-001'],
            ['name'=>'Pro Ultrabook 14',             'category'=>'Elektronik',    'price'=>20_397_300, 'stock'=>8,   'sku'=>'PUL-001'],
            ['name'=>'Signature Cotton Tee',        'category'=>'Fashion',        'price'=>706_500,    'stock'=>120, 'sku'=>'SCT-001'],
            ['name'=>'Beam Desk Lamp',              'category'=>'Rumah & Taman', 'price'=>1_397_300,  'stock'=>45,  'sku'=>'BDL-001'],
            ['name'=>'Weekender Duffel',            'category'=>'Aksesoris',      'price'=>5_024_000,  'stock'=>20,  'sku'=>'WD-001'],
            ['name'=>'NeoSound G-71',               'category'=>'Elektronik',    'price'=>3_909_300,  'stock'=>85,  'sku'=>'NS-7100-BLK'],
            ['name'=>'EcoWear Organic Tee',         'category'=>'Fashion',        'price'=>706_500,    'stock'=>120, 'sku'=>'EW-ORG-TEE'],
            ['name'=>'Vertex Chrono V2',            'category'=>'Elektronik',    'price'=>5_024_000,  'stock'=>8,   'sku'=>'VX-CHR-2024'],
            ['name'=>'Nordic Clay Vase',            'category'=>'Rumah & Taman', 'price'=>1_397_300,  'stock'=>45,  'sku'=>'NC-VASE-WHT'],
            ['name'=>'Sly Slim Wallet',             'category'=>'Aksesoris',      'price'=>1_020_500,  'stock'=>0,   'sku'=>'SL-WAL-COG'],
            ['name'=>'Premium Wireless Headphones', 'category'=>'Elektronik',    'price'=>4_698_300,  'stock'=>35,  'sku'=>'PWH-001'],
            ['name'=>'Aura Minimalist Keyboard',    'category'=>'Elektronik',    'price'=>2_340_300,  'stock'=>15,  'sku'=>'AMK-001'],
        ];

        foreach ($products as $p) {
            Product::create([
                'name'        => $p['name'],
                'slug'        => Str::slug($p['name']),
                'description' => 'Produk berkualitas tinggi dengan desain minimalis modern.',
                'price'       => $p['price'],
                'stock'       => $p['stock'],
                'category'    => $p['category'],
                'sku'         => $p['sku'],
                'is_active'   => true,
            ]);
        }
    }
}
