<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;

class Combat
{
    public function initiateCombat(Enemy $enemy): PhaseOne
    {
        return new PhaseOne();
    }
}
