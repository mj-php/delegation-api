<?php

declare(strict_types=1);

namespace Domain\Model;

use DateTime;

final class Delegation
{
    private DateTime $start;

    private DateTime $end;

    private Country $country;

    private Worker $worker;

    private float $amountDue;

    private string $currency;

    public function __construct(Country $country, Worker $worker, DateTime $start, DateTime $end, string $currency = 'PLN')
    {
        $this->start = $start;
        $this->end = $end;
        $this->country = $country;
        $this->worker = $worker;
        $this->amountDue = $this->calculateAmountDue($start, $end, $country);
        $this->currency = $currency;
    }

    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    /**
     * @return Worker
     */
    public function getWorker(): Worker
    {
        return $this->worker;
    }

    /**
     * @return DateTime
     */
    public function getStart(): DateTime
    {
        return $this->start;
    }

    /**
     * @return DateTime
     */
    public function getEnd(): DateTime
    {
        return $this->end;
    }

    /**
     * @return float
     */
    public function getAmountDue(): float
    {
        return $this->amountDue;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param DateTime $start
     * @param DateTime $end
     * @return float
     */
    public function calculateAmountDue(DateTime $start, DateTime $end, Country $country): float
    {
        $dailyStake = $country->getStake();

        $startDateMidnight = clone $start;
        $endDateMidnight = clone $end;

        $startDateMidnight->modify('+1 day');
        $startDateMidnight->setTime(0, 0);

        $endDateMidnight->modify('-1 day');
        $endDateMidnight->setTime(0, 0);

        $firstDayDiff = $startDateMidnight->diff($start, true)->h;
        $lastDayDiff = $startDateMidnight->diff($end, true)->h;

        $daysInDelegation = $end->diff($start)->d;

        $numberOfDailyStakes = $daysInDelegation + 1;

        if ($numberOfDailyStakes > 7) {
            $numberOfDailyStakes += $numberOfDailyStakes - 7;

            if ($lastDayDiff < 8) {
                $numberOfDailyStakes -= 2;
            }
        }

        if ($firstDayDiff < 8) {
            $numberOfDailyStakes -= 1;
        }

        return $numberOfDailyStakes * $dailyStake;
    }
}
