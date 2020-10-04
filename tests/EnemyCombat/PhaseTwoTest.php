<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\PhaseTwo;
use MageKnight\EnemyCombat\PhaseThree;

class PhaseTwoTest extends TestCase
{

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\PhaseTwo::execute
    */
    public function after_blocking_or_not_blocking_we_will_go_to_phase_three()
    {
        $phase = new PhaseTwo();
        $phase_three = $phase->execute();
        $this->assertInstanceof(PhaseThree::class, $phase_three);
    }
}
