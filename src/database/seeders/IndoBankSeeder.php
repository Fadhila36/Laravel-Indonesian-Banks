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
use Fadhila36\IndonesianBanks\Models\BankEloquent;

class IndoBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = IndonesianBank::getBanks();

        foreach ($banks as $bank) {
            BankEloquent::updateOrCreate(
                ['code' => $bank->code],
                $bank->toArray()
            );
        }
    }
}