<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WisataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                DB::table('wisatas')->insert([
            [
                'user_id'     => 1,
                'name'        => 'Alun-Alun Garut',
                'description' => 'Alun-alun pusat kota Garut yang menjadi tempat berkumpul warga dan wisatawan.',
                'price'       => 0,
                // 'images'      => 'alun_alun.jpg',
                // 'facilities'  => 'Parkir, Mushola, Taman, Area Jajanan',
                // 'kategori'    => 'Kota',
                'latitude'    => -7.2154,
                'longitude'   => 107.9076,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'user_id'     => 1,
                'name'        => 'Gunung Guntur',
                'description' => 'Gunung berapi aktif di Garut yang populer untuk pendakian.',
                'price'       => 15000,
                // 'images'      => 'gunung_guntur.jpg
                // 'facilities'  => 'Camping Ground, Toilet, Warung',
                // 'kategori'    => 'Gunung',
                'latitude'    => -7.1887,
                'longitude'   => 107.8123,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'user_id'     => 1,
                'name'        => 'Pantai Santolo',
                'description' => 'Pantai indah di Garut selatan dengan pasir putih dan laut biru.',
                'price'       => 10000,
                // 'images'      => 'pantai_santolo.jpg',
                // 'facilities'  => 'Parkir, Toilet, Gazebo, Perahu',
                // 'kategori'    => 'Pantai',
                'latitude'    => -7.7061,
                'longitude'   => 107.6756,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'user_id'     => 1,
                'name'        => 'Candi Cangkuang',
                'description' => 'Situs bersejarah berupa candi Hindu peninggalan abad ke-8.',
                'price'       => 10000,
                // 'images'      => 'candi_cangkuang.jpg',
                // 'facilities'  => 'Perahu, Museum, Parkir',
                // 'kategori'    => 'Sejarah',
                'latitude'    => -7.1128,
                'longitude'   => 107.9156,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'user_id'     => 1,
                'name'        => 'Kawah Kamojang',
                'description' => 'Objek wisata kawah dengan fenomena geotermal yang unik.',
                'price'       => 20000,
                // 'images'      => 'kawah_kamojang.jpg',
                // 'facilities'  => 'Pemandian Air Panas, Toilet, Parkir',
                // 'kategori'    => 'Alam',
                'latitude'    => -7.1423,
                'longitude'   => 107.7912,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
        ]);
    }
}
