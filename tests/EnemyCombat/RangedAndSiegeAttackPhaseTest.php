<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\RangedAndSiegeAttackPhase;
use MageKnight\EnemyCombat\BlockPhase;
use MageKnight\Enemy\Enemy;
use MageKnight\EnemyCombat\SiegeAttack;

class RangedAndSiegeAttackPhaseTest extends TestCase
{

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\RangedAndSiegeAttackPhase::execute
    */
    public function double_fortified_enemies_cannot_be_defeated_at_this_phase()
    {
        $phase = new RangedAndSiegeAttackPhase();
        $result = $phase->execute($this->getEnemy());
        $this->assertInstanceof(BlockPhase::class, $result->phase);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\RangedAndSiegeAttackPhase::execute
    */
    public function skip_next_phases_by_defeating_enemies_using_siege_attack()
    {
        $phase = new RangedAndSiegeAttackPhase();
        $result = $phase->execute(
            $this->getEnemyWithThreeStrength(),
            new SiegeAttack(3)
        );
        $this->assertNull($result->phase);
    }

    private function getEnemy(): Enemy
    {
        return $this->createStub(Enemy::class);
    }

    private function getEnemyWithThreeStrength(): Enemy
    {
        $enemy = $this->createMock(Enemy::class);
        $enemy->expects($this->any())
            ->method('strength')
            ->willReturn(3);
        return $enemy;
    }
}
