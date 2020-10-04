<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\RangedAndSiegeAttackPhase;
use MageKnight\EnemyCombat\BlockPhase;

class RangedAndSiegeAttackPhaseTest extends TestCase
{

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\RangedAndSiegeAttackPhase::execute
    */
    public function double_fortified_enemies_cannot_be_defeated_at_this_phase()
    {
        $phase = new RangedAndSiegeAttackPhase();
        $phase_two = $phase->execute();
        $this->assertInstanceof(BlockPhase::class, $phase_two);
    }
}
