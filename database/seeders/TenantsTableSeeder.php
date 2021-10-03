<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj' => '61399283000180',
            'name' => 'Albafer',
            'url' => 'albafer',
            'email' => 'roberto@grupoalbafer.com.br',
        ]);
    }
}
