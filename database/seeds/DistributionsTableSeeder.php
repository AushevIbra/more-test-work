<?php

use Illuminate\Database\Seeder;

class DistributionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Distribution::create([
            'account_id' => 1,
            'usd' => 15,
            'euro' => 35,
            'rub' => 50,
        ]);
    }
}
