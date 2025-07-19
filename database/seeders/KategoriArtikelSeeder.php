<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriArtikel;

class KategoriArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'nama' => 'Tips & Trik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Berita',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Edukasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Kampanye',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($kategoris as $kategori) {
            KategoriArtikel::create($kategori);
        }
    }
}
