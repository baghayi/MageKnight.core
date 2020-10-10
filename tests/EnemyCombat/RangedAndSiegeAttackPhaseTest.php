<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\RangedAndSiegeAttackPhase;
use MageKnight\EnemyCombat\BlockPhase;
use MageKnight\Enemy\Enemy;
use MageKnight\EnemyCombat\SiegeAttack;
use MageKnight\EnemyCombat\Outcomes;

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

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\RangedAndSiegeAttackPhase::execute
    */
    public function you_get_fame_by_defeating_enemy()
    {
        $phase = new RangedAndSiegeAttackPhase();
        $result = $phase->execute(
            $this->getEnemyWithThreeStrengthAndFourFame(),
            new SiegeAttack(3)
        );
        $this->assertInstanceof(Outcomes::class, $result->outcomes);
        $this->assertEquals(4, $result->outcomes['fame']);
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

    private function getEnemyWithThreeStrengthAndFourFame(): Enemy
    {
        $enemy = $this->createMock(Enemy::class);
        $enemy->expects($this->any())
            ->method('strength')
            ->willReturn(3);
        $enemy->expects($this->any())
            ->method('fame')
            ->willReturn(4);
        return $enemy;
    }
}
