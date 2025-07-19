<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            KategoriArtikelSeeder::class,
            LevelSeeder::class,
            ArtikelSeeder::class,
            BankSampahSeeder::class,
            CategorySeeder::class,
            SampahSeeder::class,
            PriceSeeder::class,
            EventSeeder::class,
            DummyUserSeeder::class,
            AddressSeeder::class,
            SetoranSeeder::class,
            PointSeeder::class,
        ]);
    }
}
