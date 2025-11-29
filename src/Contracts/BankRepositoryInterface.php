<?php

declare(strict_types=1);

namespace Fadhila36\IndonesianBanks\Contracts;

interface BankRepositoryInterface
{
    /**
     * Get all banks.
     *
     * @return array<int, \Fadhila36\IndonesianBanks\Models\Bank>
     */
    public function all(): array;

    /**
     * Find a bank by its code.
     *
     * @param string $code
     * @return \Fadhila36\IndonesianBanks\Models\Bank|null
     */
    public function find(string $code): ?\Fadhila36\IndonesianBanks\Models\Bank;

    /**
     * Search banks by name.
     *
     * @param string $name
     * @return array<int, \Fadhila36\IndonesianBanks\Models\Bank>
     */
    public function search(string $name): array;
    /**
     * Get all bank categories.
     *
     * @return array<int, string>
     */
    public function getCategories(): array;

    /**
     * Get banks by category.
     *
     * @param string $category
     * @return array<int, Bank>
     */
    public function getByCategory(string $category): array;
}
