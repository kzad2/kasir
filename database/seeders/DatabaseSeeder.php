<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Makanan;
use App\Models\Minuman;
use App\Models\menu;
use App\Models\Meja;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed user akun
        User::insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('1234'),
                'role' => 'admin',
            ],
            [
                'name' => 'kasir',
                'email' => 'kasir@gmail.com',
                'password' => bcrypt('1234'),
                'role' => 'kasir',
            ],
            [
                'name' => 'chef',
                'email' => 'chef@gmail.com',
                'password' => bcrypt('1234'),
                'role' => 'chef',
            ],
            [
                'name' => 'owner',
                'email' => 'owner@gmail.com',
                'password' => bcrypt('1234'),
                'role' => 'owner',
            ],
            [
                'name' => 'pelanggan',
                'email' => 'pelanggan@gmail.com',
                'password' => bcrypt('1234'),
                'role' => 'pelanggan',
            ],
        ]);

        $kategoriMakanan = Kategori::create(['nama' => 'Makanan']);
        $kategoriMinuman = Kategori::create(['nama' => 'Minuman']);

        $menu = [
            ['nama' => 'Sate Ayam', 'harga' => 50000, 'foto' => 'sate.jpg', 'kategori_id' => $kategoriMakanan->id],
            ['nama' => 'Nasi Uduk', 'harga' => 40000, 'foto' => 'uduk.jpg', 'kategori_id' => $kategoriMakanan->id],
            ['nama' => 'Ayam Bakar', 'harga' => 55000, 'foto' => 'ayam_bakar.jpg', 'kategori_id' => $kategoriMakanan->id],
            ['nama' => 'Bakso', 'harga' => 35000, 'foto' => 'baso.jpg', 'kategori_id' => $kategoriMakanan->id],
            ['nama' => 'Ikan Bakar', 'harga' => 60000, 'foto' => 'ikan_bakar.jpg', 'kategori_id' => $kategoriMakanan->id],
            ['nama' => 'Nasi Goreng', 'harga' => 45000, 'foto' => 'nasi_goreng.jpg', 'kategori_id' => $kategoriMakanan->id],
        ];
        foreach ($menu as $item) {
            menu::create($item);
        }

        $menu = [
            ['nama' => 'Es Teh', 'harga' => 10000, 'foto' => 'es_teh.jpg', 'kategori_id' => $kategoriMinuman->id],
            ['nama' => 'Jus Mangga', 'harga' => 15000, 'foto' => 'jus_mangga.jpg', 'kategori_id' => $kategoriMinuman->id],
            ['nama' => 'Jus Jeruk', 'harga' => 14000, 'foto' => 'jus_jeruk.jpeg', 'kategori_id' => $kategoriMinuman->id],
            ['nama' => 'Jus Kiwi', 'harga' => 16000, 'foto' => 'jus_kiwi.jpg', 'kategori_id' => $kategoriMinuman->id],
            ['nama' => 'Es Teler', 'harga' => 18000, 'foto' => 'es_teler.jpg', 'kategori_id' => $kategoriMinuman->id],
            ['nama' => 'Es Buah', 'harga' => 17000, 'foto' => 'es_buah.jpg', 'kategori_id' => $kategoriMinuman->id],
        ];
        foreach ($menu as $item) {
            menu::create($item);
        }

        // Seed meja
        $mejaData = [
            ['nomor_meja' => '01', 'status' => 'kosong'],
            ['nomor_meja' => '02', 'status' => 'terisi'],
            ['nomor_meja' => '03', 'status' => 'kosong'],
            ['nomor_meja' => '04', 'status' => 'terisi'],
            ['nomor_meja' => '05', 'status' => 'kosong'],
            ['nomor_meja' => '06', 'status' => 'terisi'],
            ['nomor_meja' => '07', 'status' => 'terisi'],
            ['nomor_meja' => '08', 'status' => 'terisi'],
        ];
        foreach ($mejaData as $item) {
            Meja::create($item);
        }
    }
}
