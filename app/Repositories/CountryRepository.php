<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Transformers\CountryTransformer;
use Domain\Exception\CountryNotFound;
use Domain\Model\Country;
use App\Models\Country as EloquentCountry;
use Domain\Repository\CountryRepositoryInterface;

class CountryRepository implements CountryRepositoryInterface
{
    private CountryTransformer $countryTransformer;

    public function __construct(CountryTransformer $countryTransformer)
    {
        $this->countryTransformer = $countryTransformer;
    }

    public function getById(int $countryId): Country
    {
        $country = EloquentCountry::find($countryId);

        if (null === $country) {
            throw CountryNotFound::forId($countryId);
        }

        return $this->countryTransformer->entityToDomain($country);
    }

    public function getByCode(string $countryCode): Country
    {
        $country = EloquentCountry::where('code', $countryCode)->first();

        if (null === $country) {
            throw CountryNotFound::forCode($countryCode);
        }

        return $this->countryTransformer->entityToDomain($country);
    }
}
