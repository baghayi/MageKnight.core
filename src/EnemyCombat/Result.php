<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

class Result
{
    public ?Phase $phase = null;
    public ?Outcomes $outcomes = null;

    public function __construct(Phase $phase = null, Outcomes $outcomes = null)
    {
        $this->phase = $phase;
        $this->outcomes = $outcomes;
    }
}
