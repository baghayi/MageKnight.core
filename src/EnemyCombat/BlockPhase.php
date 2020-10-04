<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

class BlockPhase implements Phase
{
    public function execute(): Phase
    {
        return new PhaseThree();
    }

    public function title(): string
    {
        return 'Block Phase';
    }
}
