<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // User::create ([
        //     'username' => 'admincindy',
        //     'email' => 'admincindy@gmail.com',
        //     'password' => Hash::make('admin1'),
        //     'nama_lengkap' => 'Cindy',
        //     'role' => 'administrator',
        //     'verifikasi' => 'sudah',
        //     'alamat' => 'subang'
        // ]);

        User::create ([
            'username' => 'petugas1',
            'email' => 'petugas1@gmail.com',
            'password' => Hash::make('petugas1'),
            'nama_lengkap' => 'petugas satu',
            'role' => 'petugas',
            'alamat' => 'subang',
            'verifikasi' => 'sudah'
        ]);
    }
}
