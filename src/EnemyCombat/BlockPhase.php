<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;
use MageKnight\Enemy\Swift;
use MageKnight\Enemy\Brutal;
use MageKnight\Enemy\FireAttack;

class BlockPhase implements Phase
{
    public function execute(Enemy $enemy, array $actions = []): Result
    {
        if ($this->canBlockEnemy($enemy, $actions[0] ?? null))
            return new Result(phase: new AssignDamagePhase());

        return new Result(
            phase: new AssignDamagePhase(),
            outcomes: new Outcomes([
                'hits' => $this->getEnemyAttackHits($enemy),
            ])
        );
    }

    public function title(): string
    {
        return 'Block Phase';
    }

    private function canBlockEnemy(Enemy $enemy, Block $action = null): bool
    {
        return $action instanceof Block && $this->totalBlocks($enemy, $action) >= $this->totalEnemyAttackHits($enemy);
    }

    private function totalEnemyAttackHits(Enemy $enemy): int
    {
        return ($enemy instanceof Swift) ? $enemy->attackHits() * 2 : $enemy->attackHits();
    }

    private function getEnemyAttackHits(Enemy $enemy): int
    {
        return $enemy instanceof Brutal ? $enemy->attackHits() * 2 : $enemy->attackHits();
    }

    private function totalBlocks(Enemy $enemy, Block $action): int
    {
        if ($enemy instanceof FireAttack && !$action instanceof IceBlock)
            return (int) ($action->quantity() / 2);
        else
            return $action->quantity();
    }
}
