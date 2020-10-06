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
        $outcomes = null;

        do {
            $result = $phase->execute($enemy);
            if ($result->outcomes instanceof Outcomes)
                $outcomes = $result->outcomes;
            $phase = $result->phase;
        } while($result->phase instanceof Phase);

        return $outcomes;
    }
}
