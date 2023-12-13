<?php

declare(strict_types=1);

namespace App\MatchMaker\Player {
    class BlitzPlayer extends Player
    {
        public function __construct($name = 'anonymous', $ratio = 1200.0)
        {
            parent::__construct($name, $ratio);
        }

        public function updateRatioAgainst(AbstractPlayer $player, int $result)
        {
            $this->ratio += 128 * ($result - $this->probabilityAgainst($player));
        }
    }
}