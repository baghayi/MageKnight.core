<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Player\Action;

class RangedAttack implements Action
{
    public function __construct(
        private int $quantity
    ) {
    }

    public function quantity(): int
    {
        return $this->quantity;
    }
}
