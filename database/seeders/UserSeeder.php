<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'level' => 0,
            'password' => '123',
        ];
        User::create($data);
        $data = [
            'name' => 'Super Admin',
            'email' => 'sadmin@gmail.com',
            'level' => 1,
            'password' => '123',
        ];
        User::create($data);
    }
}
