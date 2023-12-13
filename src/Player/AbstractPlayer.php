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
}