<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

class RangedAndSiegeAttackPhase implements Phase
{
    public function execute(): Result
    {
        return new Result(phase: new BlockPhase());
    }

    public function title(): string
    {
        return 'Range and Siege Attack Phase';
    }
}
