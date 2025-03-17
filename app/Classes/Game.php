<?php

namespace App\Classes;

class Game
{
    public Team $homeTeam;
    public Team $awayTeam;

    public $homeScore = 0;
    public $awayScore = 0;

    public $played = false;

    public function __construct(Team $homeTeam, Team $awayTeam) {
        $this->homeTeam = $homeTeam;
        $this->awayTeam = $awayTeam;
    }

    public function isPlayed(): bool
    {
        return $this->played;
    }

}
