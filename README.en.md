# Laravel Indonesian Banks

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fadhila36/laravel-indonesian-banks.svg?style=flat-square)](https://packagist.org/packages/fadhila36/laravel-indonesian-banks)
[![Total Downloads](https://img.shields.io/packagist/dt/fadhila36/laravel-indonesian-banks.svg?style=flat-square)](https://packagist.org/packages/fadhila36/laravel-indonesian-banks)
[![License](https://img.shields.io/packagist/l/fadhila36/laravel-indonesian-banks.svg?style=flat-square)](https://packagist.org/packages/fadhila36/laravel-indonesian-banks)

[🇮🇩 Bahasa Indonesia](README.md) | [🇺🇸 English](README.en.md)

**Laravel Indonesian Banks** is a comprehensive package providing a complete list of banks in Indonesia for your Laravel applications. This package is designed for ease of use, high performance, and flexibility.

## Key Features

-   📦 **Complete Data**: Contains a list of banks in Indonesia along with bank codes (for inter-bank transfers).
-   🚀 **Lightweight & Fast**: Uses an optimized JSON file as the default data source, without burdening the database.
-   🛠 **Flexible**: Provides Facade and Service for easy access.
-   💾 **Database Option**: Provides migrations and Eloquent models if you wish to store data in your own database.
-   🔍 **Easy Search**: Feature to search banks by name or code.
-   📂 **Categorization**: Filter banks by category (e.g., BUMN, Swasta, Syariah, BPD).

## Installation

You can install this package via Composer:

```bash
composer require fadhila36/laravel-indonesian-banks
```

This package supports Laravel's *auto-discovery* feature, so the Service Provider and Facade will be automatically registered.

## Configuration

If you wish to change the default configuration, you can publish the package configuration file:

```bash
php artisan vendor:publish --tag="indonesian-banks-config"
```

The configuration file will be copied to `config/indonesian-banks.php`. Here is an example of the basic configuration:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Bank Data Source
    |--------------------------------------------------------------------------
    |
    | This option controls the bank data source. By default (null), the package
    | uses the internal JSON file. Change to a custom file path if you wish
    | to use your own data.
    |
    */
    'file_path' => null,
];
```

## Usage

You can use the `IndonesianBank` Facade to access bank data easily.

### 1. Get All Banks

```php
use Fadhila36\IndonesianBanks\Facades\IndonesianBank;

$banks = IndonesianBank::getBanks();

foreach ($banks as $bank) {
    echo $bank->name . ' (' . $bank->code . ')';
}
```

### 2. Find Bank by Code

```php
use Fadhila36\IndonesianBanks\Facades\IndonesianBank;

$bank = IndonesianBank::findBank('014'); // Find BCA

if ($bank) {
    echo "Bank Found: " . $bank->name;
}
```

### 3. Search Bank by Name

```php
use Fadhila36\IndonesianBanks\Facades\IndonesianBank;

$results = IndonesianBank::searchBanks('Mandiri');

foreach ($results as $bank) {
    echo $bank->name . ' - ' . $bank->code;
}
```

### 4. Get Banks by Category

You can filter banks by category (e.g., `Syariah`, `BUMN`, `Swasta`, `BPD`).

```php
use Fadhila36\IndonesianBanks\Facades\IndonesianBank;

// Get all Syariah banks
$syariahBanks = IndonesianBank::getBanksByCategory('Syariah');

foreach ($syariahBanks as $bank) {
    echo $bank->name; // Output: BANK SYARIAH INDONESIA, etc.
}

// Get all available categories
$categories = IndonesianBank::getBankCategories();
// Output: ['Swasta', 'BUMN', 'Syariah', 'BPD']
```

## Complete Implementation Example

Here is an example usage in a Laravel Controller to display a list of banks in a form dropdown:

```php
namespace App\Http\Controllers;

use Fadhila36\IndonesianBanks\Facades\IndonesianBank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        // Get all bank data
        $banks = IndonesianBank::getBanks();

        return view('banks.index', compact('banks'));
    }

    public function check(Request $request)
    {
        $code = $request->input('bank_code');
        $bank = IndonesianBank::findBank($code);

        if (!$bank) {
            return back()->with('error', 'Bank not found.');
        }

        return back()->with('success', "Valid Bank: {$bank->name}");
    }
}
```

### In View (Blade)

```html
<select name="bank_code" class="form-control">
    <option value="">Select Bank</option>
    @foreach($banks as $bank)
        <option value="{{ $bank->code }}">{{ $bank->name }}</option>
    @endforeach
</select>
```

## Database Option (Advanced)

If you prefer to store bank data in your own database table (e.g., for foreign key relationships), you can publish the migration:

```bash
php artisan vendor:publish --tag="indonesian-banks-migrations"
```

Then run migrate:

```bash
php artisan migrate
```

You can then use the `Fadhila36\IndonesianBanks\Models\BankEloquent` model to interact with the `banks` table.

## Contribution

Contributions are welcome! Please create a Pull Request for bug fixes or feature additions.

1.  Fork this repository.
2.  Create a new feature branch (`git checkout -b feature/AmazingFeature`).
3.  Commit your changes (`git commit -m 'Add some AmazingFeature'`).
4.  Push to the branch (`git push origin feature/AmazingFeature`).
5.  Open a Pull Request.

## License

This package is open-source software under the [MIT](https://opensource.org/licenses/MIT) license.

---

**Made with ❤️ by [Muhammad Fadhila Abiyyu Faris](https://fadhilaabiyyu.my.id)**
