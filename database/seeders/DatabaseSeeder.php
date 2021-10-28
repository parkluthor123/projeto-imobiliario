<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'name' => 'Leandro',
            'email' => 'teste@teste.com.br',
            'password' => Hash::make('12345678'),
        ]);

        Cliente::create([
            'name' => 'Cliente 1',
            'email' => 'cliente@teste.com.br',
            'password' => Hash::make('12345678'),
        ]);
    }
}
