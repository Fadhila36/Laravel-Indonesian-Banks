declare(strict_types=1);

namespace Fadhila36\IndonesianBanks\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getBanks()
 * @method static array|null findBank(string $code)
 * @method static array searchBanks(string $name)
 *
 * @see \Fadhila36\IndonesianBanks\Services\BankService
 */
class IndonesianBank extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'indonesian-bank';
    }
}
