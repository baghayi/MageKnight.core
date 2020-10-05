<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\Phase;
use MageKnight\EnemyCombat\Result;
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
        $result = $phase->execute();
        $this->assertInstanceof(Phase::class, $result->phase);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Phase::execute
    */
    public function a_phase_may_end_with_outcomes()
    {
        $phase = $this->getPhaseWhichEndsWithOutcomes();
        $result = $phase->execute();
        $this->assertInstanceof(Outcomes::class, $result->outcomes);
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

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Phase::execute
    */
    public function phase_may_result_in_both_another_phase_and_outcomes()
    {
        $phase = $this->getPhaseWithBothNewPhaseAndOutcomes();
        $result = $phase->execute();
        $this->assertInstanceof(Outcomes::class, $result->outcomes);
        $this->assertInstanceof(Phase::class, $result->phase);
    }

    private function getPhaseWhichLeadsToAnotherPhase(): Phase
    {
        $result = new Result(
            phase: $this->createStub(Phase::class)
        );

        $phase = $this->createMock(Phase::class);
        $phase->expects($this->once())
            ->method('execute')
            ->willReturn($result);
        return $phase;
    }

    private function getPhaseWhichEndsWithOutcomes(): Phase
    {
        $result = new Result(
            outcomes: $this->createStub(Outcomes::class)
        );

        $phase = $this->createMock(Phase::class);
        $phase->expects($this->once())
            ->method('execute')
            ->willReturn($result);
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

    private function getPhaseWithBothNewPhaseAndOutcomes(): phase
    {
        $expected_result = new Result(
            outcomes: new Outcomes(),
            phase: $this->createStub(Phase::class)
        );

        $phase = $this->createMock(Phase::class);
        $phase->expects($this->once())
            ->method('execute')
            ->willReturn($expected_result);

        return $phase;
    }
}
