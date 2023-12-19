<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a admin user
        User::create([
            'name' => 'admin',
            'email' => 'naveenanatraj14@gmail.com',
            'password' => Hash::make('12345678'),
            'phone'=>'123456789',
            'experience'=>'0',
            'notice_period'=>'0',
            'skills'=>'',
            'job_location'=>1,
            'resume_path'=>'',
            'photo_path'=>'',
            'role' =>'admin'
        ]);
    }
}
