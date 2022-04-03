<?php
namespace Database\Seeders;
use App\Models\User;
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
                    'department_id'=>1,
                    'password' => bcrypt('password'),
                    'token'    => (new User(['id'=>1]))->createToken(uniqid())->plainTextToken,
                    'must_change_password' => false,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
             ],
                [
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'username'=>'jdoe',
                    'email'=>'jdoe@mail.com',
                    'department_id'=>2,
                    'password' => bcrypt('password'),
                    'token'    => (new User(['id'=>2]))->createToken(uniqid())->plainTextToken,
                    'must_change_password' => false,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'first_name' => 'Elizabeth',
                    'last_name' => 'Doe',
                    'username'=>'edoe',
                    'department_id'=>3,
                    'email'=>'edoe@mail.com',
                    'password' => bcrypt('password'),
                    'token'    => (new User(['id'=>3]))->createToken(uniqid())->plainTextToken,
                    'must_change_password' => false,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]
            ]);
    }
}
