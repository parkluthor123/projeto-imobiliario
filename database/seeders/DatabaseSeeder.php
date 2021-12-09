<?php

namespace Database\Seeders;

use App\Models\Ajuste;
use App\Models\Cliente;
use App\Models\MetaTag;
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

        MetaTag::create([
                'page_name' => 'Home',
                'keywords' => '',
                'description' => '',
                'codes' => ''
        ]);

        MetaTag::create([
            'page_name' => 'Quem Somos',
            'keywords' => '',
            'description' => '',
            'codes' => '',
        ]);

        MetaTag::create([
            'page_name' => 'Comprar ou Alugar',
            'keywords' => '',
            'description' => '',
            'codes' => '',
        ]);

        MetaTag::create([
            'page_name' => 'Vender',
            'keywords' => '',
            'description' => '',
            'codes' => '',
        ]);

        MetaTag::create([
            'page_name' => 'Contato',
            'keywords' => '',
            'description' => '',
            'codes' => '',
        ]);

        Ajuste::create([
            'footer_num1' => '',
        ]);
    }
}
