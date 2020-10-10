<?php

declare(strict_types=1);

namespace MageKnight\Enemy;

interface Enemy
{
    public function isDoubleFortified(): bool;
    public function attackHits(): int;
    public function strength(): int;
    public function fame(): int;
    public function fortified(): bool;
}
