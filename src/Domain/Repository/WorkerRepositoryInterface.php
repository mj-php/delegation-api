<?php

namespace Domain\Repository;

use Domain\Exception\WorkerNotFound;
use Domain\Model\Worker;

interface WorkerRepositoryInterface
{
    /**
     * @throws WorkerNotFound
     */
    public function getById(int $workerId): Worker;

    public function save(): Worker;
}
