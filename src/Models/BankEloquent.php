<?php

declare(strict_types=1);

namespace Fadhila36\IndonesianBanks\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Bank Eloquent Model.
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $category
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class BankEloquent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'banks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'category',
    ];
}
