<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\RangedAndSiegeAttackPhase;
use MageKnight\EnemyCombat\BlockPhase;
use MageKnight\Enemy\Enemy;

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

    private function getEnemy(): Enemy
    {
        return $this->createStub(Enemy::class);
    }
}
