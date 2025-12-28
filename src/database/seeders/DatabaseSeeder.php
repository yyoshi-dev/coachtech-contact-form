<?php

namespace Database\Seeders;

// use App\Models\User;
use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // categoriesのダミーデータの作成
        $this->call(CategoriesTableSeeder::class);

        // contactsのダミーデータの作成
        Contact::factory(35)->create();

        // usersに関してはダミーデータの作成は要件に含まれていない
        // User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
