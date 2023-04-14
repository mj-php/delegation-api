<?php

namespace App\Mappers;

class DelegationMapper
{
    private array $mappedArray;
    private array $mappingArray = [
        'start' => 'start.date',
        'end' => 'end.date',
        'country' => 'country.code',
        'amount_due' => 'amountDue',
        'currency' => 'currency'
    ];

    public function __construct(array $mappedArray)
    {
        $this->mappedArray = $mappedArray;
    }

    public function map(): array
    {
        $tmpArray = [];

        foreach ($this->mappingArray as $key => $item) {
            $internalKeys = explode('.', $item);

            $value = '';

            foreach ($internalKeys as $internalKey) {
                if (empty($value)) {
                    $value = $this->mappedArray[$internalKey];
                } else {
                    $value = $value[$internalKey];
                }
            }

            $tmpArray[$key] = $value;

        }

        return $tmpArray;
    }
}
