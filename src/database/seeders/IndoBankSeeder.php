<?php

/*
 * This file is part of the IndoBank package.
 *
 * (c) Muhammad Fadhila Abiyyu Faris <fadhilaabiyyu.my.id | fadhilaabiyyu@gmail.com>
 *
 */

namespace Fadhila36\IndonesianBanks\Database\Seeders;

use Illuminate\Database\Seeder;
use Fadhila36\IndonesianBanks\Facades\IndonesianBank;
use Illuminate\Support\Facades\DB;

class IndoBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get Data
        $banks = IndonesianBank::getBanks();

        // Convert Objects to Arrays
        $data = array_map(function ($bank) {
            return $bank->toArray();
        }, $banks);

        // Insert Data to Database
        DB::table('banks')->insert($data);
    }
}