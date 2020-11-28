<?php

declare(strict_types=1);

namespace MageKnight\EnemyCombat\Phase;

use MageKnight\EnemyCombat\Phase;
use MageKnight\Player\Action;
use MageKnight\Enemy\Enemy;
use MageKnight\Enemy\Swift;
use MageKnight\Enemy\Brutal;
use MageKnight\Enemy\FireAttack;
use MageKnight\Player\Action\Block as BlockAction;
use MageKnight\EnemyCombat\IceBlock;
use MageKnight\EnemyCombat\Result;
use MageKnight\EnemyCombat\Outcomes;
use MageKnight\EnemyCombat\Phase\AssignDamage;

class Block implements Phase
{
    public function execute(Enemy $enemy, array $actions = []): Result
    {
        if ($this->canBlockEnemy($enemy, $actions[0] ?? null))
            return new Result(phase: new AssignDamage());

        return new Result(
            phase: new AssignDamage(),
            outcomes: new Outcomes([
                'hits' => $this->getEnemyAttackHits($enemy),
            ])
        );
    }

    public function title(): string
    {
        return 'Block Phase';
    }

    private function canBlockEnemy(Enemy $enemy, Action $action = null): bool
    {
        return $action instanceof BlockAction && $this->totalBlocks($enemy, $action) >= $this->totalEnemyAttackHits($enemy);
    }

    private function totalEnemyAttackHits(Enemy $enemy): int
    {
        return ($enemy instanceof Swift) ? $enemy->attackHits() * 2 : $enemy->attackHits();
    }

    private function getEnemyAttackHits(Enemy $enemy): int
    {
        return $enemy instanceof Brutal ? $enemy->attackHits() * 2 : $enemy->attackHits();
    }

    private function totalBlocks(Enemy $enemy, BlockAction $action): int
    {
        if ($enemy instanceof FireAttack && !$action instanceof IceBlock)
            return (int) ($action->quantity() / 2);
        else
            return $action->quantity();
    }
}
