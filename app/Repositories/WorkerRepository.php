<?php

declare(strict_types = 1);

namespace App\Repositories;

use Domain\Exception\WorkerNotFound;
use Domain\Model\Worker;
use App\Models\Worker as EloquentWorker;

use App\Transformers\WorkerTransformer;
use Domain\Repository\WorkerRepositoryInterface;

class WorkerRepository implements WorkerRepositoryInterface
{
    private $workerTransformer;

    public function __construct(WorkerTransformer $workerTransformer)
    {
        $this->workerTransformer = $workerTransformer;
    }

    public function getById(int $workerId): Worker
    {
        $worker = EloquentWorker::with('delegations')->where('id',$workerId)->first();

        if (null === $worker) {
            throw WorkerNotFound::forId($workerId);
        }

        return $this->workerTransformer->entityToDomain($worker);
    }

    public function save(): Worker
    {
        $worker = EloquentWorker::make();
        $worker->save();

        return $this->workerTransformer->entityToDomain($worker);
    }
}
