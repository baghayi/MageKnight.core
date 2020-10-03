<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\Phase;

class PhaseTest extends TestCase
{
    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Phase::execute
    */
    public function each_phase_may_lead_to_another_phase()
    {
        $phase = $this->getPhaseWhichLeadsToAnotherPhase();
        $new_phase = $phase->execute();
        $this->assertInstanceof(Phase::class, $new_phase);
    }

    private function getPhaseWhichLeadsToAnotherPhase(): Phase
    {
        $phase = $this->createMock(Phase::class);
        $phase->expects($this->once())
            ->method('execute')
            ->willReturn($this->createStub(Phase::class));
        return $phase;
    }
}
