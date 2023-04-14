<?php

declare(strict_types=1);

namespace Domain\Exception;

final class WorkerAlreadyOnDelegation extends DomainException
{
    public static function forDelegation(int $delegationId): self
    {
        return new self(
            sprintf("Worker already on delegation with id %s", $delegationId)
        );
    }


}
