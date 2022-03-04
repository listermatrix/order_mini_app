<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::query()->truncate();

        DB::table('users')->insert(
            [
                [
                    'first_name' => 'zedek',
                    'last_name' => 'mel',
                    'username'=>'zedek',
                    'email'=>'zedek@mail.com',
                    'password' => bcrypt('password'),
                    'must_change_password' => false,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
             ],
                [
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'username'=>'jdoe',
                    'email'=>'jdoe@mail.com',
                    'password' => bcrypt('password'),
                    'must_change_password' => false,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'first_name' => 'Elizabeth',
                    'last_name' => 'Doe',
                    'username'=>'edoe',
                    'email'=>'edoe@mail.com',
                    'password' => bcrypt('password'),
                    'must_change_password' => false,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]
            ]);
    }
}
