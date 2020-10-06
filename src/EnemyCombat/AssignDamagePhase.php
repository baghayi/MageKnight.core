<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;

class AssignDamagePhase implements Phase
{
    public function execute(Enemy $enemy): Result
    {
        return new Result(phase: new AttackPhase());
    }

    public function title(): string
    {
        return 'Assign Damage Phase';
    }
}
