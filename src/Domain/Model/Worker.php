<?php

declare(strict_types=1);

namespace Domain\Model;

use DateTime;
use Domain\Exception\StartGreaterThanEnd;
use Domain\Exception\WorkerAlreadyOnDelegation;

final class Worker
{
    private int $id;

    public function __construct(
        int   $id,
        array $delegations = []
    )
    {
        $this->id = $id;
        $this->delegations = $delegations;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getDelegations(): array
    {
        return $this->delegations;
    }

    /**
     * @param Country $country
     * @return Delegation
     * @throws WorkerAlreadyOnDelegation
     * @throws StartGreaterThanEnd
     */
    public function participate(Country $country, \DateTime $start, \DateTime $end, float $amount = 0): Delegation
    {
        $delegations = $this->getDelegations();

        foreach ($delegations as $delegation) {
            $startDate = DateTime::createFromFormat('Y-m-d H:i:s', $delegation['start']);
            $endDate = DateTime::createFromFormat('Y-m-d H:i:s', $delegation['end']);

            if ($startDate >= $start && $startDate <= $end
                || $endDate >= $start && $endDate <= $end
            ) {
                throw WorkerAlreadyOnDelegation::forDelegation($delegation['id']);
            }
        }

        if ($start > $end) {
            throw StartGreaterThanEnd::forTime($start);
        }

        $delegation = new Delegation($country, $this, $start, $end);

        $this->delegations[] = $delegation;

        return $delegation;
    }
}
