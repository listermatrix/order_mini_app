<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $currency =  Currency::query();
       $currency->truncate();


       $now = now();

        $currency->insert(
            [
                [
                    'name' =>'EUROS',
                    'code' =>'EUR',
                    'created_at' =>$now,
                    'updated_at' =>$now,
                ],
                [
                    'name' =>'US DOLLAR',
                    'code' =>'USD',
                    'created_at' =>$now,
                    'updated_at' =>$now,
                ],
                [
                    'name' =>'NIGERIA NAIRA',
                    'code' =>'NGN',
                    'created_at' =>$now,
                    'updated_at' =>$now,
                ],
            ]
        );

    }
}
