<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;
use MageKnight\Player\Action;

class RangedAndSiegeAttackPhase implements Phase
{
    public function execute(Enemy $enemy, Action $action = null): Result
    {
        if ($action instanceof SiegeAttack && $enemy->strength() <= $action->quantity())
            return new Result();

        return new Result(phase: new BlockPhase());
    }

    public function title(): string
    {
        return 'Range and Siege Attack Phase';
    }
}
