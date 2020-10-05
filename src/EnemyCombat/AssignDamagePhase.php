<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

class AssignDamagePhase implements Phase
{
    public function execute(): Result
    {
        return new Result(phase: new AttackPhase());
    }

    public function title(): string
    {
        return 'Assign Damage Phase';
    }
}
