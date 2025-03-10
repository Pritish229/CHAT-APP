<?php

namespace Database\Seeders;

use App\Models\ManageUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ManageUser::create([
            'f_name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone_no' => '9999999999',
            'image' => null,
            'password' => Hash::make('admin@2024'), 
            'c_password' => Hash::make('admin@2024'),
            'user_role' => 0, 
        ]);
    }
}
