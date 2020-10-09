<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;
use MageKnight\Player\Action;

interface Phase
{
    public function execute(Enemy $enemy, Action $action = null): Result;
    public function title(): string;
}
