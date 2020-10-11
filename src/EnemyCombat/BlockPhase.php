<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;

class BlockPhase implements Phase
{
    public function execute(Enemy $enemy, array $actions = []): Result
    {
        if ($this->canBlockEnemy($enemy, $actions[0] ?? null))
            return new Result(phase: new AssignDamagePhase());

        return new Result(
            phase: new AssignDamagePhase(),
            outcomes: new Outcomes([
                'hits' => $enemy->attackHits()
            ])
        );
    }

    public function title(): string
    {
        return 'Block Phase';
    }

    private function canBlockEnemy(Enemy $enemy, Block $action = null): bool
    {
        return $action instanceof Block && $action->quantity() >= $enemy->attackHits();
    }
}
