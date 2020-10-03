<?php

declare(strict_types=1);

namespace Test\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\Combat;
use MageKnight\EnemyCombat\PhaseOne;
use MageKnight\Enemy\Enemy;
use MageKnight\Enemy\EnemyGroup;

class CombatTest extends TestCase
{
    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Combat::initiateCombat
    */
    public function initiating_combat_takes_to_phase_one_in_combat()
    {
        $combat = new Combat();
        $phase_one = $combat->initiateCombat($this->getEnemy());
        $this->assertInstanceOf(PhaseOne::class, $phase_one);
    }

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Combat::initiateCombat
    */
    public function initiatte_attack_on_group_of_enemies()
    {
        $combat = new Combat();
        $phase_one = $combat->initiateCombat(
            new EnemyGroup([$this->getEnemy(), $this->getEnemy()])
        );
        $this->assertInstanceOf(PhaseOne::class, $phase_one);
    }

    private function getEnemy(): Enemy
    {
        return $this->createStub(Enemy::class);
    }
}
