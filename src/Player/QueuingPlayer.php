<?php

declare(strict_types=1);

namespace App\MatchMaker\Player {
    class QueuingPlayer extends Player
    {
        public $range;
        public function __construct(AbstractPlayer $player, $range = 1)
        {
            parent::__construct($player->getName(), $player->getRatio());
            $this->range = $range;
        }

        public function getRange(): int
        {
            return $this->range;
        }

        public function upgradeRange()
        {
            $this->range = min($this->range + 1, 40);
        }
    }
}