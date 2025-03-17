<?php

namespace App\Classes;

class GameSimulator
{
    public static function playGame(Game $game)
    {
        $homeTeam = $game->homeTeam;
        $awayTeam = $game->awayTeam;

        // Scores according to power of team and last matches form
        $score1 = rand(0, 2) + floor(($homeTeam->rating * $homeTeam->getFormFactor()) / 20);
        $score2 = rand(0, 2) + floor(($awayTeam->rating * $awayTeam->getFormFactor()) / 20);

        $game->homeScore += $score1;
        $game->awayScore += $score2;

        $homeTeam->scored += $score1;
        $homeTeam->conceded += $score2;

        $awayTeam->scored += $score2;
        $awayTeam->conceded += $score1;

        // First team won
        if ($score1 > $score2) {
            $homeTeam->addPoints(3);

            $homeTeam->wins++;
            $awayTeam->losses++;

            $homeTeam->recordMatch('W');
            $awayTeam->recordMatch('L');
        } elseif ($score2 > $score1) {
            $awayTeam->addPoints(3);

            $homeTeam->losses++;
            $awayTeam->wins++;

            $homeTeam->recordMatch('L');
            $awayTeam->recordMatch('W');
        } else { // Draw
            $homeTeam->addPoints(1);
            $awayTeam->addPoints(1);

            $homeTeam->draws++;
            $awayTeam->draws++;

            $homeTeam->recordMatch('D');
            $awayTeam->recordMatch('D');
        }

        // Set match as played
        $game->played = true;
    }
}
