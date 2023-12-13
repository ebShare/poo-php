<?php

declare(strict_types=1);

namespace App\MatchMaker\Player {
    abstract class AbstractPlayer
    {
        public $name;
        public $ratio;
        public function __construct($name = 'anonymous', $ratio = 400.0)
        {
            $this->name = $name;
            $this->ratio = $ratio;
        }

        abstract public function getName(): string;

        abstract public function getRatio(): float;

        abstract protected function probabilityAgainst(self $player): float;

        abstract public function updateRatioAgainst(self $player, int $result);
    }

    class Player extends AbstractPlayer
    {
        public function getName(): string
        {
            return $this->name;
        }

        protected function probabilityAgainst(AbstractPlayer $player): float
        {
            return 1 / (1 + (10 ** (($player->getRatio() - $this->getRatio()) / 400)));
        }

        public function updateRatioAgainst(AbstractPlayer $player, int $result)
        {
            $this->ratio += 32 * ($result - $this->probabilityAgainst($player));
        }

        public function getRatio(): float
        {
            return $this->ratio;
        }
    }

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