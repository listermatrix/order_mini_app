<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\ExchangeRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExchangeRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ex = ExchangeRate::query();
        $ex->truncate();


        $now = now();


        $data  = [
            [
                'source_currency'=> $this->getCurrencyId('USD'),
                'target_currency'=> $this->getCurrencyId('NGN'),
                'rate'=> '415.958',
                'inverse'=> '0.00240409',
                'created_at'=> $now,
                'updated_at'=> $now,
            ],

            [
                'source_currency'=> $this->getCurrencyId('USD'),
                'target_currency'=> $this->getCurrencyId('EUR'),
                'rate'=> '0.903610',
                'inverse'=> '1.10667',
                'created_at'=> $now,
                'updated_at'=> $now,
            ],

            [
                'source_currency'=> $this->getCurrencyId('EUR'),
                'target_currency'=> $this->getCurrencyId('NGN'),
                'rate'=> '460.313',
                'inverse'=> '0.00217251',
                'created_at'=> $now,
                'updated_at'=> $now,
            ]

        ];


        $ex->insert($data);
    }


    public function getCurrencyId($code)
    {
       return Currency::query()->where('code',$code)->first()->id ?? '';
    }
}
