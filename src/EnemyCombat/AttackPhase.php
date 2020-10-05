<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

class AttackPhase implements Phase
{

    public function execute(): Result
    {
        return new Result(outcomes: new Outcomes());
    }

    public function title(): string
    {
    }
}
