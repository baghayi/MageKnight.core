<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

class AssignDamagePhase implements Phase
{
    public function execute(): Phase
    {
        return new AttackPhase();
    }

    public function title(): string
    {
        return 'Assign Damage Phase';
    }
}
