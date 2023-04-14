<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Country as Entity;
use Domain\Model\Country as Domain;

class CountryTransformer
{
    public function __construct()
    {
    }

    public function entityToDomain(Entity $entity): Domain
    {
        $delegationId = $entity->id;

        return new Domain($delegationId, $entity->name, $entity->code, $entity->stake);
    }

    public function domainToEntity(Domain $domain): Entity
    {
        $entity = new Entity();
        $entity->id = $domain->getId();
        $entity->name = $domain->getName();
        $entity->code = $domain->getCode();
        $entity->stake = $domain->getStake();

        return $entity;
    }
}
