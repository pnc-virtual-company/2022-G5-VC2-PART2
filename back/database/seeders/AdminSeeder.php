<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coordinator = [
            'first_name' => 'sauth',
            'last_name' => 'phouek',
            'email' => 'sauth.phouek@passerellesnumeriques.org',
            'password' => Hash::make('pnc'),
            'roles' => 'Coordinator',
            'gender' => 'Male',
            'profile' => 'admin.png'
        ];
        User::create($coordinator);
    }
}
