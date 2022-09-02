<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipa;
use App\Models\Jogador;
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
        Equipa::factory()->count(20)->has(
            Jogador::factory()->count(22)->state(function($attributes, Equipa $equipa) {
                return ['id_equipa' => $equipa->id];
            }),
            'jogadores'
        )->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
