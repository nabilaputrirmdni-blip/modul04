<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            [
                'nama_kategori' => 'Teknologi',
                'deskripsi' => 'Buku yang membahas perkembangan teknologi dan pemrograman'
            ],
            [
                'nama_kategori' => 'Sains',
                'deskripsi' => 'Buku yang membahas ilmu pengetahuan alam dan eksperimen'
            ],
            [
                'nama_kategori' => 'Sastra',
                'deskripsi' => 'Buku karya sastra seperti novel, puisi, dan cerpen'
            ],
        ]);
    }
}

