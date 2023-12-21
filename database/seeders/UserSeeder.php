<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// import Facades DB
use Illuminate\Support\Facades\DB;
// import Hash tuk enkripsi
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //kode ini untuk input data ke tabel User
        DB::table("users")->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => hash::make('admin123'),
        ]);
    }
}
