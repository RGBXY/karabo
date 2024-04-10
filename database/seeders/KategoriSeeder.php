<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'nama_kategori'=>'Game',
            'slug'=>'game',
        ]);

        Kategori::create([
            'nama_kategori'=>'Konspirasi',
            'slug'=>'konspirasi',
        ]);
        Kategori::create([
            'nama_kategori'=>'Politik',
            'slug'=>'politik',
        ]);
        Kategori::create([
            'nama_kategori'=>'Pelajaran',
            'slug'=>'pelajaran',
        ]);
        Kategori::create([
            'nama_kategori'=>'Buku',
            'slug'=>'buku',
        ]);
        Kategori::create([
            'nama_kategori'=>'Sejarah',
            'slug'=>'sejarah',
        ]);
        Kategori::create([
            'nama_kategori'=>'Olahraga',
            'slug'=>'olahraga',
        ]);
    }
}
