<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;

class AttackPhase implements Phase
{

    public function execute(Enemy $enemy, array $actions = []): Result
    {
        return new Result(outcomes: new Outcomes());
    }

    public function title(): string
    {
    }
}
