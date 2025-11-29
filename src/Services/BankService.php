<?php

declare(strict_types=1);

namespace Fadhila36\IndonesianBanks\Services;

use Fadhila36\IndonesianBanks\Contracts\BankRepositoryInterface;
use Fadhila36\IndonesianBanks\Models\Bank;

final class BankService
{
    /**
     * The bank repository instance.
     *
     * @var BankRepositoryInterface
     */
    protected $repository;

    /**
     * The cached banks data.
     *
     * @var array<int, \Fadhila36\IndonesianBanks\Models\Bank>|null
     */
    protected $banks = null;

    /**
     * Create a new service instance.
     *
     * @param  BankRepositoryInterface  $repository
     */
    public function __construct(BankRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all banks.
     *
     * @return array<int, Bank>
     */
    public function getBanks(): array
    {
        if ($this->banks === null) {
            $this->banks = $this->repository->all();
        }

        return $this->banks;
    }

    /**
     * Find a bank by its code.
     *
     * @param  string  $code
     * @return Bank|null
     */
    public function findBank(string $code): ?Bank
    {
        // Use repository directly if not cached, or search in cache if already loaded?
        // For consistency and to allow repository optimization (e.g. DB query), we should delegate.
        // However, if we already loaded all banks, searching in memory is faster than DB query.
        // But here we are using JSON file, so repository.all() reads file.
        // If we use repository.find(), it might read file again if not careful.
        // The current repository implementation reads file in all() and find() calls all().
        // So it's better to use the cached $this->banks if available.
        
        if ($this->banks !== null) {
            foreach ($this->banks as $bank) {
                if ($bank->code === $code) {
                    return $bank;
                }
            }
            return null;
        }

        return $this->repository->find($code);
    }

    /**
     * Search banks by name.
     *
     * @param  string  $name
     * @return array<int, Bank>
     */
    public function searchBanks(string $name): array
    {
        if ($this->banks !== null) {
            $results = [];
            foreach ($this->banks as $bank) {
                if (stripos($bank->name, $name) !== false) {
                    $results[] = $bank;
                }
            }
            return $results;
        }

        return $this->repository->search($name);
    }
    /**
     * Get all bank categories.
     *
     * @return array<int, string>
     */
    public function getBankCategories(): array
    {
        return $this->repository->getCategories();
    }

    /**
     * Get banks by category.
     *
     * @param string $category
     * @return array<int, Bank>
     */
    public function getBanksByCategory(string $category): array
    {
        return $this->repository->getByCategory($category);
    }
}
