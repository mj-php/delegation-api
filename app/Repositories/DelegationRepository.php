<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\Transformers\DelegationTransformer;
use Common\ObjectConverter;
use Domain\Model\Delegation;
use App\Models\Delegation as EloquentDelegation;

use Domain\Repository\DelegationRepositoryInterface;

class DelegationRepository implements DelegationRepositoryInterface
{
    private DelegationTransformer $delegationTransformer;

    public function __construct(DelegationTransformer $delegationTransformer)
    {
        $this->delegationTransformer = $delegationTransformer;
    }

    public function getById(int $delegationId): Delegation
    {
        $delegation = EloquentDelegation::find($delegationId);

        if (null === $delegation) {
            throw EloquentDelegation::forId($delegationId);
        }

        return $this->delegationTransformer->entityToDomain($delegation);
    }

    public function getManyByWorkerId(int $workerId): array
    {
        $delegations = EloquentDelegation::where('worker_id',$workerId)->get();

        if (empty($delegations)) {
            throw EloquentDelegation::forId($workerId);
        }

        $delegationsDomain = [];

        foreach ($delegations as $delegation) {
            $delegationsDomain[] = ObjectConverter::objectToArray($this->delegationTransformer->entityToDomain($delegation));
        }

        return $delegationsDomain;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Delegation $delegation): void
    {
        $dbDelegation = $this->delegationTransformer->domainToEntity($delegation);

        $dbDelegation->save();
    }
}
