<?php

declare(strict_types = 1);

namespace Domain\Repository;

use Domain\Exception\CountryNotFound;
use Domain\Model\Country;

interface CountryRepositoryInterface
{
    /**
     * @throws CountryNotFound
     */
    public function getById(int $id): Country;

    public function getByCode(string $code): Country;
}
