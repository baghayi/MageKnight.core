<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;
use MageKnight\Player\Action;

class RangedAndSiegeAttackPhase implements Phase
{
    public function execute(Enemy $enemy, Action $action = null): Result
    {
        if ($this->canDefeat($enemy, $action))
            return new Result(outcomes: new Outcomes(['fame' => $enemy->fame()]));

        return new Result(phase: new BlockPhase());
    }

    public function title(): string
    {
        return 'Range and Siege Attack Phase';
    }

    private function canDefeat(Enemy $enemy, Action $action = null): bool
    {
        return $action instanceof SiegeAttack && $enemy->strength() <= $action->quantity();
    }
}
