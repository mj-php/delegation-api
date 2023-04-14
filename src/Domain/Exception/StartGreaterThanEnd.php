<?php

declare(strict_types=1);

namespace Domain\Exception;

final class StartGreaterThanEnd extends DomainException
{
    public static function forTime(\DateTime $start): self
    {
        return new self(
            sprintf("End date can't be earlier than %s", $start->format('Y-m-d H:i:s'))
        );
    }
}
