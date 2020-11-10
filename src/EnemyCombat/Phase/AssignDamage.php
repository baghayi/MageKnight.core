<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat\Phase;

use MageKnight\Enemy\Enemy;
use MageKnight\EnemyCombat\Phase;
use MageKnight\EnemyCombat\Result;
use MageKnight\EnemyCombat\AttackPhase;

class AssignDamage implements Phase
{
    public function execute(Enemy $enemy, array $actions = []): Result
    {
        return new Result(phase: new AttackPhase());
    }

    public function title(): string
    {
        return 'Assign Damage Phase';
    }
}
