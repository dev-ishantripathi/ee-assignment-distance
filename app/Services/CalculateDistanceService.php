<?php

namespace App\Services;

use App\Actions\CalculateDistanceFromHqAction;

class CalculateDistanceService
{
    public function __construct(private array $locations)
    {
    }

    public function fromHq(): array
    {
        $hqAddress = config('hq.address');

        return [(new CalculateDistanceFromHqAction())->execute($hqAddress, $this->locations)];
    }
}
