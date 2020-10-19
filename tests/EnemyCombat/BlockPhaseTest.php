<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\BlockPhase;
use MageKnight\EnemyCombat\AssignDamagePhase;
use MageKnight\EnemyCombat\Outcomes;
use MageKnight\EnemyCombat\Block;
use MageKnight\Enemy\Enemy;
use MageKnight\Enemy\Swift;
use MageKnight\Enemy\Brutal;

class BlockPhaseTest extends TestCase
{

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\BlockPhase::execute
    */
    public function after_blocking_or_not_blocking_we_will_go_to_phase_three()
    {
        $phase = new BlockPhase();
        $result = $phase->execute($this->getEnemy());
        $this->assertInstanceof(AssignDamagePhase::class, $result->phase);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\BlockPhase::execute
    */
    public function non_blocked_enemies_deals_damage()
    {
        $phase = new BlockPhase();
        $result = $phase->execute($this->getEnemyWithThreeAttackHits());
        $this->assertInstanceof(Outcomes::class, $result->outcomes);
        $this->assertEquals(3, $result->outcomes['hits']);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\BlockPhase::execute
    */
    public function avoid_damage_by_blocking_enemies()
    {
        $phase = new BlockPhase();
        $result = $phase->execute(
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
        $phase = new BlockPhase();
        $result = $phase->execute( $this->getSwiftEnemyWithThreeAttackHits(), [new Block(3)]);
        $this->assertEquals(3, $result->outcomes['hits'] ?? null, "Should have been hit by 3");

        $phase = new BlockPhase();
        $result = $phase->execute( $this->getSwiftEnemyWithThreeAttackHits(), [new Block(5)]);
        $this->assertEquals(3, $result->outcomes['hits'] ?? null, "Should have been hit by 3");

        $phase = new BlockPhase();
        $result = $phase->execute( $this->getSwiftEnemyWithThreeAttackHits(), [new Block(6)]);
        $this->assertNull($result->outcomes);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\BlockPhase::execute
    */
    public function unblocked_brutal_enemies_hit_twice_their_attack_hits()
    {
        $phase = new BlockPhase();
        $result = $phase->execute($this->getBrutalEnemyWithThreeAttackHits(), []);
        $this->assertEquals(6, $result->outcomes['hits'] ?? null, "Should have been hit by 6");
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
}
