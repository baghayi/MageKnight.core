<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use MageKnight\Enemy\Enemy;

interface Phase
{
    public function execute(Enemy $enemy): Result;
    public function title(): string;
}
