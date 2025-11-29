<?php

declare(strict_types=1);

namespace Fadhila36\IndonesianBanks\Repositories;

use Fadhila36\IndonesianBanks\Contracts\BankRepositoryInterface;
use Fadhila36\IndonesianBanks\Models\Bank;

final class BankRepository implements BankRepositoryInterface
{
    /**
     * The path to the JSON file.
     *
     * @var string
     */
    protected $jsonPath;

    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(
        protected \Illuminate\Contracts\Config\Repository $config
    ) {
        $path = $this->config->get('indonesian-banks.file_path');
        $this->jsonPath = $path ?: __DIR__.'/../data/json/banks.json';
    }

    /**
     * Get all banks from the JSON file.
     *
     * @return array<int, Bank>
     */
    public function all(): array
    {
        if (! file_exists($this->jsonPath)) {
            return [];
        }

        $json = file_get_contents($this->jsonPath);
        if ($json === false) {
            return [];
        }

        /** @var array<int, array{code: string, name: string}> $data */
        $data = json_decode($json, true);
        if (! is_array($data)) {
            return [];
        }

        $banks = [];
        foreach ($data as $item) {
            $banks[] = new Bank($item['code'], $item['name'], $item['category'] ?? null);
        }

        return $banks;
    }

    /**
     * Find a bank by its code.
     *
     * @param string $code
     * @return Bank|null
     */
    public function find(string $code): ?Bank
    {
        $banks = $this->all();

        foreach ($banks as $bank) {
            if ($bank->code === $code) {
                return $bank;
            }
        }

        return null;
    }

    /**
     * Search banks by name.
     *
     * @param string $name
     * @return array<int, Bank>
     */
    public function search(string $name): array
    {
        $banks = $this->all();
        $results = [];

        foreach ($banks as $bank) {
            if (stripos($bank->name, $name) !== false) {
                $results[] = $bank;
            }
        }

        return $results;
    }

    /**
     * Get all bank categories.
     *
     * @return array<int, string>
     */
    public function getCategories(): array
    {
        $banks = $this->all();
        $categories = [];

        foreach ($banks as $bank) {
            if ($bank->category && !in_array($bank->category, $categories)) {
                $categories[] = $bank->category;
            }
        }

        return $categories;
    }

    /**
     * Get banks by category.
     *
     * @param string $category
     * @return array<int, Bank>
     */
    public function getByCategory(string $category): array
    {
        $banks = $this->all();
        $results = [];

        foreach ($banks as $bank) {
            if ($bank->category && stripos($bank->category, $category) !== false) {
                $results[] = $bank;
            }
        }

        return $results;
    
    }
}
