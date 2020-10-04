<?php

declare(strict_types=1);

namespace Test\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\Combat;
use MageKnight\EnemyCombat\RangedAndSiegeAttackPhase;
use MageKnight\EnemyCombat\PhaseTwo;
use MageKnight\Enemy\Enemy;

class CombatTest extends TestCase
{
    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Combat::initiateCombat
    */
    public function initiating_combat_takes_to_phase_one_in_combat()
    {
        $combat = new Combat();
        $phase_one = $combat->initiateCombat($this->getEnemy());
        $this->assertInstanceOf(RangedAndSiegeAttackPhase::class, $phase_one);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Combat::initiateCombat
    */
    public function skip_phase_one_of_combat_on_double_fortified_enemies()
    {
        $combat = new Combat();
        $combat_phase = $combat->initiateCombat($this->getDoubleFortifiedEnemy());
        $this->assertInstanceOf(PhaseTwo::class, $combat_phase);
    }

    private function getEnemy(): Enemy
    {
        $enemy = $this->createMock(Enemy::class);
        $enemy->expects($this->once())
            ->method('isDoubleFortified')
            ->willReturn(false);
        return $enemy;
    }

    private function getDoubleFortifiedEnemy(): Enemy
    {
        $enemy = $this->createMock(Enemy::class);
        $enemy->expects($this->once())
            ->method('isDoubleFortified')
            ->willReturn(true);
        return $enemy;
    }
}
