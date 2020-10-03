<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

class PhaseOne implements Phase
{
    public function execute(): Phase
    {
        return new PhaseTwo();
    }
}
