<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;
use MageKnight\Enemy\EnemyGroup;

class Combat
{
    public function initiateCombat(Enemy $enemy): Outcomes
    {
        $phase = new RangedAndSiegeAttackPhase();
        do {
            $phase = $phase->execute();
            if ($phase instanceof Outcomes)
                return $phase;
        } while($phase instanceof Phase);
    }
}
