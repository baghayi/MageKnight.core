<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;
use MageKnight\EnemyCombat\Block;

interface Phase
{
    public function execute(Enemy $enemy, Block $action = null): Result;
    public function title(): string;
}
