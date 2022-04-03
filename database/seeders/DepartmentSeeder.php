<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dep = Department::query();
        $dep->truncate();


        $now = now();


        $data  = [
            [
                'name'=> 'Picking Department',
                'description'=> 'Picking Department DESC',
                'email'=> 'test@mail2.com',
                'created_at'=> $now,
                'updated_at'=> $now,
            ],

            [
                'name'=> 'Shipping Department',
                'description'=> 'Shipping Department DESC',
                'email'=> 'test@mail.com',
                'created_at'=> $now,
                'updated_at'=> $now,
            ],

            [
                'name'=> 'Management Department',
                'description'=>'Management Department',
                'email'=> 'test@mail.com',
                'created_at'=> $now,
                'updated_at'=> $now,
            ],


        ];


        $dep->insert($data);
    }



}
