<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat;

use ArrayAccess;

class Outcomes implements ArrayAccess
{
    private $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset] ?? null;
    }

    public function offsetSet($offset, $value): void
    {
    }

    public function offsetUnset( $offset): void
    {
    }
}
