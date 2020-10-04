<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

interface Phase
{
    public function execute(): Phase|Outcomes;
    public function title(): string;
}
