<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;
use MageKnight\Player\Action;

class AttackPhase implements Phase
{

    public function execute(Enemy $enemy, Action $action = null): Result
    {
        return new Result(outcomes: new Outcomes());
    }

    public function title(): string
    {
    }
}
