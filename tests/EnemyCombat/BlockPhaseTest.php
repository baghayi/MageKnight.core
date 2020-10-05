<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\BlockPhase;
use MageKnight\EnemyCombat\AssignDamagePhase;

class BlockPhaseTest extends TestCase
{

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\BlockPhase::execute
    */
    public function after_blocking_or_not_blocking_we_will_go_to_phase_three()
    {
        $phase = new BlockPhase();
        $result = $phase->execute();
        $this->assertInstanceof(AssignDamagePhase::class, $result->phase);
    }
}
