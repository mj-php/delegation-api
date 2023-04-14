<?php

declare(strict_types=1);

namespace Domain\Model;

final class Country
{
    private int $id;
    private string $name;
    private string $code;
    private int $stake;

    public function __construct(int $id, string $name, string $code, int $stake)
    {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->stake = $stake;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getStake(): int
    {
        return $this->stake;
    }
}
