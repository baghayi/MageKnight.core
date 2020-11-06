<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;
use MageKnight\Enemy\EnemyGroup;

class Combat
{
    public function initiateCombat(Enemy $enemy, array $actions = []): Outcomes
    {
        $phase = new RangedAndSiegeAttackPhase();
        $outcomes = [];

        do {
            $result = $phase->execute($enemy, $actions);
            if ($result->outcomes instanceof Outcomes)
                $outcomes = array_merge($outcomes, $result->outcomes->data);
            $phase = $result->phase;
        } while($result->phase instanceof Phase);

        return new Outcomes($outcomes);
    }
}
