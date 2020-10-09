<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;
use MageKnight\Player\Action;

class AssignDamagePhase implements Phase
{
    public function execute(Enemy $enemy, Action $action = null): Result
    {
        return new Result(phase: new AttackPhase());
    }

    public function title(): string
    {
        return 'Assign Damage Phase';
    }
}
