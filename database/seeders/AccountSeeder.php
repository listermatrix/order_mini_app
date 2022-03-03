<?php
namespace Database\Seeders;
use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $account  =  Account::query();
       $account->truncate();


        $account->insert(
          [
              ['user_id' => 1, 'name' => 'USD ACC', 'currency_id' => (new ExchangeRateSeeder)->getCurrencyId('USD'), 'balance'=>1000.00, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
              ['user_id' => 1, 'name' => 'EUR ACC', 'currency_id' => (new ExchangeRateSeeder)->getCurrencyId('EUR'), 'balance'=>00.00,   'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
              ['user_id' => 1, 'name' => 'NGN ACC', 'currency_id' => (new ExchangeRateSeeder)->getCurrencyId('NGN'), 'balance'=>00.00,   'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],


              ['user_id' => 2, 'name' => 'USD ACC', 'currency_id' => (new ExchangeRateSeeder)->getCurrencyId('USD'), 'balance'=>00.00,   'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
              ['user_id' => 2, 'name' => 'EUR ACC', 'currency_id' => (new ExchangeRateSeeder)->getCurrencyId('EUR'), 'balance'=>1000.00, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
              ['user_id' => 2, 'name' => 'NGN ACC', 'currency_id' => (new ExchangeRateSeeder)->getCurrencyId('NGN'), 'balance'=>00.00,   'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],

              ['user_id' => 3, 'name' => 'USD ACC', 'currency_id' => (new ExchangeRateSeeder)->getCurrencyId('USD'), 'balance'=>00.00,  'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
              ['user_id' => 3, 'name' => 'EUR ACC', 'currency_id' => (new ExchangeRateSeeder)->getCurrencyId('EUR'), 'balance'=>00.00,  'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
              ['user_id' => 3, 'name' => 'NGN ACC', 'currency_id' => (new ExchangeRateSeeder)->getCurrencyId('NGN'), 'balance'=>1000.00,'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
          ]
        );
    }
}
