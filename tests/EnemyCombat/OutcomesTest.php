<?php

declare(strict_types=1);

namespace Test\MageKnight\EnemyCombat;

use PHPUnit\Framework\TestCase;
use MageKnight\EnemyCombat\Outcomes;

class OutcomesTest extends TestCase
{

    /**
    * @test
    * @covers \MageKnight\EnemyCombat\Outcomes::merge
    */
    public function merging_two_outcomes_results_in_another()
    {
        $outcome_1 = new Outcomes(['fame' => 1]);
        $outcome_2 = new Outcomes(['hits' => 2]);
        $resulting_outcome = $outcome_1->merge($outcome_2);
        $this->assertSame(1, $resulting_outcome['fame']);
        $this->assertSame(2, $resulting_outcome['hits']);
    }
}
