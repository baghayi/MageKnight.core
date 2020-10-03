<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;
use MageKnight\Enemy\EnemyGroup;

class Combat
{
    public function initiateCombat(Enemy|EnemyGroup $enemy): PhaseOne
    {
        return new PhaseOne();
    }
}
