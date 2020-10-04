<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

class PhaseTwo implements Phase
{
    public function execute(): Phase
    {
        return new PhaseOne();
    }

    public function title(): string
    {
        return 'Block Phase';
    }
}
