<?php
declare(strict_types=1);
namespace {

    require_once("Player.php");
    require_once("Lobby.php");
    /*
     * This file is part of the OpenClassRoom PHP Object Course.
     *
     * (c) Grégoire Hébert <contact@gheb.dev>
     *
     * For the full copyright and license information, please view the LICENSE
     * file that was distributed with this source code.
     */

    

    $greg = new App\MatchMaker\Player\BlitzPlayer('greg');
    $jade = new App\MatchMaker\Player\BlitzPlayer('jade');

    $lobby = new App\MatchMaker\Lobby\Lobby();
    $lobby->addPlayers($greg, $jade);

    var_dump($lobby->findOponents($lobby->queuingPlayers[0]));

    exit(0);
}

