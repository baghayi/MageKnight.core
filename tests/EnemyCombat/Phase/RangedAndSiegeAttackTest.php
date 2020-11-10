<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat\Phase;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\Phase\RangedAndSiegeAttack;
use MageKnight\EnemyCombat\Phase\Block;
use MageKnight\EnemyCombat\Phase;
use MageKnight\Enemy\Enemy;
use MageKnight\Enemy\Fortified;
use MageKnight\EnemyCombat\SiegeAttack;
use MageKnight\EnemyCombat\RangedAttack;
use MageKnight\EnemyCombat\Outcomes;

class RangedAndSiegeAttackTest extends TestCase
{

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Phase\RangedAndSiegeAttack::execute
    */
    public function double_fortified_enemies_cannot_be_defeated_at_this_phase()
    {
        $phase = new RangedAndSiegeAttack();
        $result = $phase->execute($this->getDoubleFortifiedEnemy());
        $this->assertInstanceof(Block::class, $result->phase);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Phase\RangedAndSiegeAttack::execute
    */
    public function skip_next_phases_by_defeating_enemies_using_siege_attack()
    {
        $phase = new RangedAndSiegeAttack();
        $result = $phase->execute(
            $this->getEnemyWithThreeStrength(),
            [new SiegeAttack(3)]
        );
        $this->assertNull($result->phase);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Phase\RangedAndSiegeAttack::execute
    */
    public function you_get_fame_by_defeating_enemy()
    {
        $phase = new RangedAndSiegeAttack();
        $result = $phase->execute(
            $this->getEnemyWithThreeStrengthAndFourFame(),
            [new SiegeAttack(3)]
        );
        $this->assertInstanceof(Outcomes::class, $result->outcomes);
        $this->assertEquals(4, $result->outcomes['fame']);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Phase\RangedAndSiegeAttack::execute
    */
    public function can_also_defeat_enemies_using_ranged_attack()
    {
        $phase = new RangedAndSiegeAttack();
        $result = $phase->execute(
            $this->getEnemyWithThreeStrength(),
            [new RangedAttack(3)]
        );
        $this->assertNull($result->phase);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Phase\RangedAndSiegeAttack::execute
    */
    public function cannot_defeat_fortified_enemies_with_ranged_attack()
    {
        $phase = new RangedAndSiegeAttack();
        $result = $phase->execute(
            $this->getFortifiedEnemyOfStrengthOne(),
            [new RangedAttack(3)]
        );
        $this->assertInstanceof(Phase::class, $result->phase);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Phase\RangedAndSiegeAttack::execute
    */
    public function can_defeat_enemies_by_combining_siege_and_ranged_attack_together()
    {
        $phase = new RangedAndSiegeAttack();
        $result = $phase->execute(
            $this->getEnemyWithThreeStrengthAndFourFame(),
            [new SiegeAttack(2), new RangedAttack(1)]
        );
        $this->assertEquals(4, $result->outcomes['fame']);
    }

    private function getDoubleFortifiedEnemy(): Enemy
    {
        $e = $this->createMock(Enemy::class);
        $e->expects($this->any())
            ->method('isDoubleFortified')
            ->willReturn(true);
        return $e;
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

    private function getFortifiedEnemyOfStrengthOne(): Enemy
    {
        $enemy = $this->createMock(Fortified::class);
        $enemy->expects($this->any())
            ->method('strength')
            ->willReturn(1);
        return $enemy;
    }
}
