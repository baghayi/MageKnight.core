<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\PhaseOne;
use MageKnight\EnemyCombat\PhaseTwo;

class PhaseOneTest extends TestCase
{

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\PhaseOne::execute
    */
    public function double_fortified_enemies_cannot_be_defeated_at_this_phase()
    {
        $phase = new PhaseOne();
        $phase_two = $phase->execute();
        $this->assertInstanceof(PhaseTwo::class, $phase_two);
    }
}
