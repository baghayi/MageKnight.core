<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

class BlockPhase implements Phase
{
    public function execute(): Result
    {
        return new Result(phase: new AssignDamagePhase());
    }

    public function title(): string
    {
        return 'Block Phase';
    }
}
