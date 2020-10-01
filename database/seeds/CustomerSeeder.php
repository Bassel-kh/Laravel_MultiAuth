<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Customer::create([
            'name' => 'Customer',
            'email' => 'customer@customer.com',
            'password' => bcrypt('adminadmin'),
        ]);
    }
}
