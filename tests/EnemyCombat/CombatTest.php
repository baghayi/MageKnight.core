<?php

declare(strict_types=1);

namespace Test\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\Combat;
use MageKnight\EnemyCombat\Outcomes;
use MageKnight\EnemyCombat\RangedAttack;
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
        $combat = new Combat();
        $outcomes = $combat->initiateCombat($this->getEnemy(strength: 3, attack_hits: 4, fame: 5), [new RangedAttack(3)]);
        $this->assertNull($outcomes['hits'], 'Should not get any hits!');
        $this->assertEquals(5, $outcomes['fame'], 'Should get fame after defeating enemy in Ranged And Siege Attack phase!');
    }

    private function getEnemy(int $strength = 0, int $attack_hits = 0, int $fame = 0): Enemy
    {
        $enemy = $this->createMock(Enemy::class);
        $enemy->expects($this->any())->method('fame')->willReturn($fame);
        $enemy->expects($this->any())->method('strength')->willReturn($strength);
        $enemy->expects($this->any())->method('attackHits')->willReturn($attack_hits);
        return $enemy;
    }
}
