<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Worker as Entity;
use Domain\Model\Worker as Domain;

class WorkerTransformer
{

    public function __construct()
    {
    }

    public function entityToDomain(Entity $entity): Domain
    {
        $workerId = $entity->id;
        $delegations = $entity->delegations->toArray();

        return new Domain($workerId, $delegations);
    }

    public function domainToEntity(Domain $domain): Entity
    {
        $entity = new Entity();
        $entity->id = $domain->getId();

        return $entity;
    }
}
