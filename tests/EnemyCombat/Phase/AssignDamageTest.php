<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\Phase\AssignDamage;
use MageKnight\EnemyCombat\AttackPhase;
use MageKnight\Enemy\Enemy;

class AssignDamageTest extends TestCase
{
    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Phase\AssignDamage::execute
    */
    public function after_this_phase_there_is_an_attack_phase()
    {
        $phase = new AssignDamage();
        $result = $phase->execute($this->getEnemy());
        $this->assertInstanceof(AttackPhase::class, $result->phase);
    }

    private function getEnemy(): Enemy
    {
        return $this->createStub(Enemy::class);
    }
}
