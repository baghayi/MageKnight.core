<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;

class BlockPhase implements Phase
{
    public function execute(Enemy $enemy): Result
    {
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
}
