<?php

declare(strict_types = 1);

namespace Domain\Exception;

final class WorkerNotFound extends DomainException
{
    public static function forId(int $id): self
    {
        return new self(
            sprintf("Worker with id %s not found", $id)
        );
    }
}
