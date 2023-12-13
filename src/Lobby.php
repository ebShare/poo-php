<?php

declare(strict_types=1);

namespace App\MatchMaker\Lobby {
    use App\MatchMaker\Player\QueuingPlayer;
    use App\MatchMaker\Player\Player;

    class Lobby
    {
        /** @var array<QueuingPlayer> */
        public $queuingPlayers = [];

        public function findOponents(QueuingPlayer $player): array
        {
            $minLevel = round($player->getRatio() / 100);
            $maxLevel = $minLevel + $player->getRange();

            return array_filter($this->queuingPlayers, static function (QueuingPlayer $potentialOponent) use ($minLevel, $maxLevel, $player) {
                $playerLevel = round($potentialOponent->getRatio() / 100);

                return $player !== $potentialOponent && ($minLevel <= $playerLevel) && ($playerLevel <= $maxLevel);
            });
        }
 
        public function addPlayer(Player $player)
        {
            $this->queuingPlayers[] = new QueuingPlayer($player);
        }

        public function addPlayers(Player ...$players)
        {
            foreach ($players as $player) {
                $this->addPlayer($player);
            }
        }
    }
}
