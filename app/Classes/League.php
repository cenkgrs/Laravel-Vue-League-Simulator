<?php

namespace App\Classes;

class League {
    public int $weekCount;
    private array $teams = [];
    private array $games = [];
    public int $weekMatchCount;

    public function addTeam(Team $team): void
    {
        $this->teams[] = $team;
    }

    public function generateFixture(): void
    {
        $teamsCount = count($this->teams);

        for ($round = 1; $round < $teamsCount; $round++) {
            for ($i = 0; $i < $teamsCount / 2; $i++) {
                $home = $this->teams[$i];
                $away = $this->teams[$teamsCount - 1 - $i];

                $this->games[] = new Game($home, $away);
            }

            array_splice($this->teams, 1, 0, array_splice($this->teams, -1, 1));
        }

        $this->weekMatchCount = count($this->games) / 2;
    }

    public function getWeeklyMatchCount(): int
    {
        return $this->weekMatchCount;
    }

    public function getGames(): array
    {
        return $this->games;
    }

    public function getTeams(): array
    {
        return $this->teams;
    }
}
