<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\BlockPhase;
use MageKnight\EnemyCombat\AssignDamagePhase;
use MageKnight\EnemyCombat\Outcomes;
use MageKnight\Enemy\Enemy;

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
}
