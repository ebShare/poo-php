<?php

class Player
{
    private $level;
    public function getLevel():int{
        return $this->level;
    }
    public function setLevel(int $level){
        $this->level=$level;
    }
    public function __construct(int $level){
        $this->level=$level;
    }
}
class Encounter
{
    const RESULT_WINNER = 1;
    const RESULT_LOSER = -1;
    const RESULT_DRAW = 0;
    const RESULT_POSSIBILITIES = [self::RESULT_WINNER, self::RESULT_LOSER, self::RESULT_DRAW];
    public static function probabilityAgainst(int $levelPlayerOne, int $againstLevelPlayerTwo)
    {
        return 1 / (1 + (10 ** (($againstLevelPlayerTwo - $levelPlayerOne) / 400)));
    }
    public static function setNewLevel(Player &$PlayerOne, Player $PlayerTwo, int $playerOneResult)
    {
        if (!in_array($playerOneResult, self::RESULT_POSSIBILITIES)) {
            trigger_error(sprintf('Invalid result. Expected %s', implode(' or ', self::RESULT_POSSIBILITIES)));
        }

        $PlayerOne->setLevel($PlayerOne->getLevel()+(int) (32 * ($playerOneResult - self::probabilityAgainst($PlayerOne->getLevel(), $PlayerTwo->getLevel()))));
    }
}





$greg = new Player(400);
$jade = new Player(800);

echo sprintf(
    'Greg à %.2f%% chance de gagner face a Jade',
    Encounter::probabilityAgainst($greg->getLevel(), $jade->getLevel()) * 100
) . PHP_EOL;

// Imaginons que greg l'emporte tout de même.
Encounter::setNewLevel($greg, $jade, Encounter::RESULT_WINNER);
Encounter::setNewLevel($jade, $greg, Encounter::RESULT_LOSER);

echo sprintf(
    'les niveaux des joueurs ont évolués vers %s pour Greg et %s pour Jade',
    $greg->getLevel(),
    $jade->getLevel()
);

exit(0);