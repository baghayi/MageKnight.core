<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;
use MageKnight\Enemy\EnemyGroup;

class Combat
{
    public function initiateCombat(Enemy $enemy, array $actions = []): Outcomes
    {
        $phase = new Phase\RangedAndSiegeAttack();
        $outcomes = new Outcomes;

        do {
            $result = $phase->execute($enemy, $actions);
            if ($result->outcomes instanceof Outcomes)
                $outcomes = $outcomes->merge($result->outcomes);
            $phase = $result->phase;
        } while($result->phase instanceof Phase);

        return $outcomes;
    }
}
