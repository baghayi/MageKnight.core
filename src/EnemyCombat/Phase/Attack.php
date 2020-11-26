<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat\Phase;

use MageKnight\Enemy\Enemy;
use MageKnight\EnemyCombat\Phase;
use MageKnight\EnemyCombat\Result;

class Attack implements Phase
{

    public function execute(Enemy $enemy, array $actions = []): Result
    {
        return new Result(outcomes: new Outcomes());
    }

    public function title(): string
    {
    }
}
