<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Delegation as Entity;
use Domain\Model\Delegation as Domain;

class DelegationTransformer
{
    const DATETIME_FORMAT = 'Y-m-d H:i:s';
    private CountryTransformer $countryTransformer;
    private WorkerTransformer $workerTransformer;

    public function __construct(CountryTransformer $countryTransformer, WorkerTransformer $workerTransformer)
    {
        $this->countryTransformer = $countryTransformer;
        $this->workerTransformer = $workerTransformer;
    }

    public function entityToDomain(Entity $entity): Domain
    {
        $dbCountry = $entity->country()->get()->pop();
        $dbWorker = $entity->worker()->get()->pop();

        $dbStart = \DateTime::createFromFormat(self::DATETIME_FORMAT, $entity->start);
        $dbEnd = \DateTime::createFromFormat(self::DATETIME_FORMAT, $entity->end);

        $worker = $this->workerTransformer->entityToDomain($dbWorker);
        $country = $this->countryTransformer->entityToDomain($dbCountry);

        return new Domain($country, $worker, $dbStart, $dbEnd);
    }

    public function domainToEntity(Domain $domain): Entity
    {
        $entity = new Entity();
        $entity->country_id = $domain->getCountry()->getId();
        $entity->worker_id = $domain->getWorker()->getId();
        $entity->start = $domain->getStart();
        $entity->end = $domain->getEnd();
        $entity->amount_due = $domain->getAmountDue();

        return $entity;
    }
}
