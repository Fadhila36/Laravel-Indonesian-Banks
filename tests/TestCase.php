<?php

namespace Fadhila36\IndonesianBanks\Tests;

use Fadhila36\IndonesianBanks\Providers\IndonesianBanksServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            IndonesianBanksServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
