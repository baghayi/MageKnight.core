<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

class AttackPhase implements Phase
{

    public function execute(): Outcomes
    {
        return new Outcomes();
    }

    public function title(): string
    {
    }
}
