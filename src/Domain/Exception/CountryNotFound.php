<?php

declare(strict_types=1);

namespace Domain\Exception;

final class CountryNotFound extends DomainException
{
    public static function forId(int $id): self
    {
        return new self(
            sprintf("Country with id %s not found", $id)
        );
    }

    public static function forCode(string $code): self
    {
        return new self(
            sprintf("Country with code %s not found", $code)
        );
    }
}
