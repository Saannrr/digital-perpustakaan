<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Buku::create([
            'judul' => 'atomic habits',
            'slug' => Str::slug('atomic-habits'),
            'sampul' => 'buku/cover/Atomic habits_cover.jpg',
            'file_buku' => 'buku/file-buku/Atomic habits_file.pdf',
            'penulis' => 'james clear',
            'penerbit_id' => 2,
            'kategori_id' => 3,
            'total_pembaca' => 10,
            'user_id' => 1
        ]);

        Buku::create([
            'judul' => 'attack on titan volume 1',
            'slug' => Str::slug('attack-on-titan-volume-1'),
            'sampul' => 'buku/cover/Attack on Titan - Volume 1_cover.jpg',
            'file_buku' => 'buku/file-buku/Attack on Titan - Volume 1_file.pdf',
            'penulis' => 'hajime isayama',
            'penerbit_id' => 2,
            'kategori_id' => 5,
            'total_pembaca' => 20,
            'user_id' => 1
        ]);

        Buku::create([
            'judul' => 'belajar laravel',
            'slug' => Str::slug('belajar-laravel'),
            'sampul' => 'buku/cover/Belajar Laravel_cover.jpg',
            'file_buku' => 'buku/file-buku/Belajar Laravel_file.pdf',
            'penulis' => 'eko siswanto',
            'penerbit_id' => 3,
            'kategori_id' => 4,
            'total_pembaca' => 17,
            'user_id' => 1
        ]);

        Buku::create([
            'judul' => 'berani tidak disukai',
            'slug' => Str::slug('berani-tidak-disukai'),
            'sampul' => 'buku/cover/Berani Tidak Disukai_cover.jpg',
            'file_buku' => 'buku/file-buku/Berani Tidak Disukai_file.pdf',
            'penulis' => 'ichiro kishimi & fumitake koga',
            'penerbit_id' => 2,
            'kategori_id' => 3,
            'total_pembaca' => 11,
            'user_id' => 1
        ]);

        Buku::create([
            'judul' => 'detective conan volume 1',
            'slug' => Str::slug('detective-conan-volume-1'),
            'sampul' => 'buku/cover/Detective Conan 01_cover.jpg',
            'file_buku' => 'buku/file-buku/Detective Conan 01_file.pdf',
            'penulis' => 'aoyama gosho',
            'penerbit_id' => 2,
            'kategori_id' => 5,
            'total_pembaca' => 15,
            'user_id' => 1
        ]);

        Buku::create([
            'judul' => 'your name',
            'slug' => Str::slug('your-name'),
            'sampul' => 'buku/cover/Kimi no Na wa_cover.jpg',
            'file_buku' => 'buku/file-buku/Kimi no Na wa_file.pdf',
            'penulis' => 'makoto shinkai',
            'penerbit_id' => 2,
            'kategori_id' => 2,
            'total_pembaca' => 23,
            'user_id' => 1
        ]);

        Buku::create([
            'judul' => 'rich dad poor dad',
            'slug' => Str::slug('rich-dad-poor-dad'),
            'sampul' => 'buku/cover/Rich Dad Poor Dad_cover.jpg',
            'file_buku' => 'buku/file-buku/Rich Dad Poor Dad_file.pdf',
            'penulis' => 'robert kiyosaki',
            'penerbit_id' => 2,
            'kategori_id' => 6,
            'total_pembaca' => 14,
            'user_id' => 1
        ]);
    }
}
