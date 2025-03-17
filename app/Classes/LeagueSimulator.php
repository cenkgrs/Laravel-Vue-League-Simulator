<?php

namespace App\Classes;

class LeagueSimulator
{
    private League $league;
    private int $simulationCount;

    public function __construct(League $league, int $simulationCount = 1000)
    {
        $this->league = $league;
        $this->simulationCount = $simulationCount;
    }

    public function simulateChampionshipOdds() : array
    {
        $ods = [];

        $teams = $this->league->getTeams();

        $championCounts = array_fill_keys(array_map(fn($t) => $t->name, $teams), 0);

        for ($i = 0; $i < $this->simulationCount; $i++) {
            $simulatedTeams = [];

            foreach ($teams as $team) {
                $simulatedTeams[$team->name] = clone $team;
            }

            foreach ($this->league->getGames() as $game) {
                $this->simulateMatch($simulatedTeams[$game->homeTeam->name], $simulatedTeams[$game->awayTeam->name]);
            }

            usort($simulatedTeams, fn($a, $b) => $b->points <=> $a->points);
            $championCounts[$simulatedTeams[0]->name]++;
        }

        foreach ($championCounts as $team => $count) {
            $percentage = ($count / $this->simulationCount) * 100;
            $ods[] = ["team" => $team, "odd" => number_format($percentage, 2) . "%"];
        }

        return $ods;
    }

    private function simulateMatch(Team $team1, Team $team2) :void
    {
        $form1 = $team1->getFormFactor();
        $form2 = $team2->getFormFactor();

        $goal1 = rand(0, 2) + floor(($team1->rating * $form1) / 20);
        $goal2 = rand(0, 2) + floor(($team2->rating * $form2) / 20);

        if ($goal1 > $goal2) {
            $team1->addPoints(3);
        } elseif ($goal2 > $goal1) {
            $team2->addPoints(3);
        } else {
            $team1->addPoints(1);
            $team2->addPoints(1);
        }
    }
}
