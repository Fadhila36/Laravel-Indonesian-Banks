<?php

declare(strict_types=1);

namespace Fadhila36\IndonesianBanks\Models;

final class Bank
{
    /**
     * Create a new bank instance.
     *
     * @param  string  $code
     * @param  string  $name
     */
    public function __construct(
        public readonly string $code,
        public readonly string $name,
        public readonly ?string $category = null,
    ) {}

    /**
     * Convert the object to an array.
     *
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'category' => $this->category,
        ];
    }
}
