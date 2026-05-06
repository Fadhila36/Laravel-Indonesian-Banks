<?php

use Fadhila36\IndonesianBanks\Facades\IndonesianBank;
use Fadhila36\IndonesianBanks\Models\Bank;

it('can get all banks', function () {
    $banks = IndonesianBank::getBanks();
    
    expect($banks)->toBeArray()
        ->and(count($banks))->toBeGreaterThan(0)
        ->and($banks[0])->toBeInstanceOf(Bank::class);
});

it('can find a bank by code', function () {
    $bank = IndonesianBank::findBank('014'); // BCA
    
    expect($bank)->not->toBeNull()
        ->and($bank->name)->toBe('BANK BCA');
});

it('can search banks by name', function () {
    $results = IndonesianBank::searchBanks('Mandiri');
    
    expect($results)->toBeArray()
        ->and(count($results))->toBeGreaterThan(0)
        ->and($results[0]->name)->toContain('MANDIRI');
});

it('can get banks by category', function () {
    $banks = IndonesianBank::getBanksByCategory('Syariah');
    
    expect($banks)->toBeArray()
        ->and(count($banks))->toBeGreaterThan(0)
        ->and($banks[0]->category)->toBe('Syariah');
});

it('can get all categories', function () {
    $categories = IndonesianBank::getBankCategories();
    
    expect($categories)->toBeArray()
        ->and($categories)->toContain('Swasta')
        ->and($categories)->toContain('BUMN');
});
