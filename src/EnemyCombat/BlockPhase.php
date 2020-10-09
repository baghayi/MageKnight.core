<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;
use MageKnight\Player\Action;

class BlockPhase implements Phase
{
    public function execute(Enemy $enemy, Action $action = null): Result
    {
        if ($this->canBlockEnemy($enemy, $action))
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
