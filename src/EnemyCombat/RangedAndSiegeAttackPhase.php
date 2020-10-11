<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;
use MageKnight\Player\Action;

class RangedAndSiegeAttackPhase implements Phase
{
    public function execute(Enemy $enemy, array $actions = []): Result
    {
        if ($this->canDefeat($enemy, $actions))
            return new Result(outcomes: new Outcomes(['fame' => $enemy->fame()]));
        return new Result(phase: new BlockPhase());
    }

    public function title(): string
    {
        return 'Range and Siege Attack Phase';
    }

    private function canDefeat(Enemy $enemy, array $actions = []): bool
    {
        if($enemy->isDoubleFortified())
            return false;
        if ($enemy->fortified() && !$this->haveEnoughSiegeAttack($enemy, ...$actions))
            return false;
        return $this->totalAttacks(...$actions) >= $enemy->strength();
    }

    private function haveEnoughSiegeAttack(Enemy $enemy, Action ...$actions): bool
    {
        return $this->totalSiegeAttacks(...$actions) >= $enemy->strength();
    }

    private function totalSiegeAttacks(Action ...$actions): int
    {
        return array_reduce($actions, function(int $carry, Action $a) {
            return $carry + ($a instanceof SiegeAttack ? $a->quantity() : 0);
        }, 0);
    }

    private function totalAttacks(Action ...$actions): int
    {
        return array_reduce($actions, function(int $carry, Action $a) {
            return $carry + ($a instanceof RangedAttack || $a instanceof SiegeAttack ? $a->quantity() : 0);
        }, 0);
    }
}
