<?php

namespace Domain\Repository;

use Domain\Model\Delegation;

interface DelegationRepositoryInterface
{
    public function getById(int $delegationId): Delegation;

    public function getManyByWorkerId(int $workerId): array;
    public function save(Delegation $delegation): void;
}
