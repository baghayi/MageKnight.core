<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

class PhaseThree implements Phase
{
    public function execute(): Phase
    {
    }

    public function title(): string
    {
        return 'Assign Damage Phase';
    }
}
