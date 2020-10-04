<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\AssignDamagePhase;
use MageKnight\EnemyCombat\AttackPhase;

class AssignDamagePhaseTest extends TestCase
{
    /**
    * @test
    * @covers \MageKnight\EnemyCombat\AssignDamagePhase::execute
    */
    public function after_this_phase_there_is_an_attack_phase()
    {
        $phase = new AssignDamagePhase();
        $attack_phase = $phase->execute();
        $this->assertInstanceof(AttackPhase::class, $attack_phase);
    }
}
