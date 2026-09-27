<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Kinan',
            'email' => 'admin@aksarastore.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081381949010',
            'address' => 'Kantor Pusat AksaraStore, Jakarta'
        ]);

        User::create([
            'name' => 'Customer Demo',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '089876543210',
            'address' => 'Jl. Merdeka No. 45, Jakarta'
        ]);

        $cat1 = Category::create(['name' => 'Teknologi', 'slug' => 'teknologi']);
        $cat2 = Category::create(['name' => 'Novel', 'slug' => 'novel']);
        $cat3 = Category::create(['name' => 'Bisnis & Finansial', 'slug' => 'bisnis-finansial']);
        $cat4 = Category::create(['name' => 'Self Development', 'slug' => 'self-development']);

        Book::create([
            'category_id' => $cat1->id,
            'title' => 'Mastering HTML & CSS',
            'author' => 'Novi Septiana',
            'description' => 'Panduan komprehensif membangun aplikasi web modern, terstruktur, dan scalable dengan ekosistem Laravel terkini.',
            'price' => 125000,
            'stock' => 20,
            'cover' => null
        ]);

        Book::create([
            'category_id' => $cat2->id,
            'title' => 'Satu Persen Kemungkinan',
            'author' => 'Zainudin Bachtera',
            'description' => 'Kisah inspiratif tentang perjuangan, mimpi, dan persahabatan di tengah hiruk-pikuk kota metropolitan.',
            'price' => 85000,
            'stock' => 15,
            'cover' => null
        ]);

        Book::create([
            'category_id' => $cat3->id,
            'title' => 'Langkah Kecil, Bisnis Besar',
            'author' => 'Arthur Morgan',
            'description' => 'Memahami pola pikir dan perilaku manusia terhadap uang serta cara mengelola aset dengan bijak.',
            'price' => 98000,
            'stock' => 25,
            'cover' => null
        ]);

        Book::create([
            'category_id' => $cat4->id,
            'title' => 'The Art of Becoming',
            'author' => 'Micah Bell',
            'description' => 'Cara mudah dan terbukti untuk membentuk kebiasaan baik dan menghilangkan kebiasaan buruk setiap hari.',
            'price' => 110000,
            'stock' => 30,
            'cover' => null
        ]);
    }
}
