<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

interface Phase
{
    public function execute(): Result;
    public function title(): string;
}
