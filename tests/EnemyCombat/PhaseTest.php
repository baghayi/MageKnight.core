<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\Phase;
use MageKnight\EnemyCombat\Outcomes;

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

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Phase::execute
    */
    public function a_phase_may_end_with_outcomes()
    {
        $phase = $this->getPhaseWhichEndsWithOutcomes();
        $outcomes = $phase->execute();
        $this->assertInstanceof(Outcomes::class, $outcomes);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Phase::title
    */
    public function human_friendly_phase_title()
    {
        $phase = $this->getPhaseWithHumanFriendlyTitle();
        $this->assertSame('Range and Siege Attack Phase', $phase->title());
    }

    private function getPhaseWhichLeadsToAnotherPhase(): Phase
    {
        $phase = $this->createMock(Phase::class);
        $phase->expects($this->once())
            ->method('execute')
            ->willReturn($this->createStub(Phase::class));
        return $phase;
    }

    private function getPhaseWhichEndsWithOutcomes(): Phase
    {
        $phase = $this->createMock(Phase::class);
        $phase->expects($this->once())
            ->method('execute')
            ->willReturn($this->createStub(Outcomes::class));
        return $phase;
    }

    private function getPhaseWithHumanFriendlyTitle(): Phase
    {
        $phase = $this->createMock(Phase::class);
        $phase->expects($this->once())
            ->method('title')
            ->willReturn('Range and Siege Attack Phase');
        return $phase;
    }
}
