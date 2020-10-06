<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\AssignDamagePhase;
use MageKnight\EnemyCombat\AttackPhase;
use MageKnight\Enemy\Enemy;

class AssignDamagePhaseTest extends TestCase
{
    /**
    * @test
    * @covers \MageKnight\EnemyCombat\AssignDamagePhase::execute
    */
    public function after_this_phase_there_is_an_attack_phase()
    {
        $phase = new AssignDamagePhase();
        $result = $phase->execute($this->getEnemy());
        $this->assertInstanceof(AttackPhase::class, $result->phase);
    }

    private function getEnemy(): Enemy
    {
        return $this->createStub(Enemy::class);
    }
}
