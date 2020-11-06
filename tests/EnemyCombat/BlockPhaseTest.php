<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\BlockPhase;
use MageKnight\EnemyCombat\AssignDamagePhase;
use MageKnight\EnemyCombat\Outcomes;
use MageKnight\EnemyCombat\Block;
use MageKnight\EnemyCombat\IceBlock;
use MageKnight\EnemyCombat\ColdFireBlock;
use MageKnight\Enemy\Enemy;
use MageKnight\Enemy\Swift;
use MageKnight\Enemy\Brutal;
use MageKnight\Enemy\FireAttack;

class BlockPhaseTest extends TestCase
{
    private BlockPhase $phase;

    public function setUp(): void
    {
        $this->phase = new BlockPhase();
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\BlockPhase::execute
    */
    public function after_blocking_or_not_blocking_we_will_go_to_phase_three()
    {
        $result = $this->phase->execute($this->getEnemy());
        $this->assertInstanceof(AssignDamagePhase::class, $result->phase);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\BlockPhase::execute
    */
    public function non_blocked_enemies_deals_damage()
    {
        $result = $this->phase->execute($this->getEnemyWithThreeAttackHits());
        $this->assertInstanceof(Outcomes::class, $result->outcomes);
        $this->assertEquals(3, $result->outcomes['hits']);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\BlockPhase::execute
    */
    public function avoid_damage_by_blocking_enemies()
    {
        $result = $this->phase->execute(
            $this->getEnemyWithThreeAttackHits(),
            [new Block(3)]
        );
        $this->assertNull($result->outcomes);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\BlockPhase::execute
    */
    public function swift_enemies_has_to_be_blocked_double_to_their_attack_hits()
    {
        $result = $this->phase->execute( $this->getSwiftEnemyWithThreeAttackHits(), [new Block(3)]);
        $this->assertEquals(3, $result->outcomes['hits'] ?? null, "Should have been hit by 3");

        $result = $this->phase->execute( $this->getSwiftEnemyWithThreeAttackHits(), [new Block(5)]);
        $this->assertEquals(3, $result->outcomes['hits'] ?? null, "Should have been hit by 3");

        $result = $this->phase->execute( $this->getSwiftEnemyWithThreeAttackHits(), [new Block(6)]);
        $this->assertNull($result->outcomes);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\BlockPhase::execute
    */
    public function unblocked_brutal_enemies_hit_twice_their_attack_hits()
    {
        $result = $this->phase->execute($this->getBrutalEnemyWithThreeAttackHits(), []);
        $this->assertEquals(6, $result->outcomes['hits'] ?? null, "Should have been hit by 6");
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\BlockPhase::execute
    */
    public function fire_attack_enemies_could_be_blocked_by_ice_blocks_efficiently()
    {
        $result = $this->phase->execute($this->getFireAttackEnemy(attack_hits: 3), [new IceBlock(3)]);
        $this->assertNull($result->outcomes, "Should not get any hits");
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\BlockPhase::execute
    */
    public function total_blocks_are_halved_when_blocking_fire_attack_enemies_with_normal_block()
    {
        $result = $this->phase->execute($this->getFireAttackEnemy(attack_hits: 3), [new Block(6)]);
        $this->assertNull($result->outcomes, "Should not get any hits");

        $result = $this->phase->execute($this->getFireAttackEnemy(attack_hits: 3), [new Block(5)]);
        $this->assertNotNull($result->outcomes, "We get hits!");
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\BlockPhase::execute
    */
    public function fire_attack_enemies_could_be_blocked_by_cold_fire_blocks_efficiently()
    {
        $result = $this->phase->execute($this->getFireAttackEnemy(attack_hits: 3), [new ColdFireBlock(3)]);
        $this->assertNull($result->outcomes, "Should not get any hits");
    }

    private function getEnemy(): Enemy
    {
        return $this->createStub(Enemy::class);
    }

    private function getEnemyWithThreeAttackHits(): Enemy
    {
        $enemy = $this->createMock(Enemy::class);
        $enemy->expects($this->any())
            ->method('attackHits')
            ->willReturn(3);
        return $enemy;
    }

    private function getSwiftEnemyWithThreeAttackHits(): Enemy
    {
        $enemy = $this->createMock(Swift::class);
        $enemy->expects($this->any())
            ->method('attackHits')
            ->willReturn(3);
        return $enemy;
    }

    private function getBrutalEnemyWithThreeAttackHits(): Enemy
    {
        $enemy = $this->createMock(Brutal::class);
        $enemy->expects($this->any())
            ->method('attackHits')
            ->willReturn(3);
        return $enemy;
    }

    private function getFireAttackEnemy(int $attack_hits): Enemy
    {
        $enemy = $this->createMock(FireAttack::class);
        $enemy->expects($this->any())
            ->method('attackHits')
            ->willReturn($attack_hits);
        return $enemy;
    }
}
