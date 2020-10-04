<?php

declare(strict_types=1);

namespace Test\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\Combat;
use MageKnight\EnemyCombat\Outcomes;
use MageKnight\Enemy\Enemy;

class CombatTest extends TestCase
{
    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Combat::initiateCombat
    */
    public function each_combat_ends_with_its_outcomes()
    {
        $combat = new Combat();
        $outcomes = $combat->initiateCombat($this->getEnemy());
        $this->assertInstanceof(Outcomes::class, $outcomes);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Combat::initiateCombat
    */
    public function initiating_combat_takes_to_phase_one_in_combat()
    {
        $this->markTestSkipped();
    }

    private function getEnemy(): Enemy
    {
        return $this->createStub(Enemy::class);
    }
}
