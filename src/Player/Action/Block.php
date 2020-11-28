<?php

declare(strict_types=1);

namespace MageKnight\Player\Action;

use MageKnight\Player\Action;

class Block implements Action
{
    public function __construct(
        private int $quantity
    ){
    }

    public function quantity(): int
    {
        return $this->quantity;
    }
}
