<?php

namespace App\Http\Controllers;

use App\Classes\GameSimulator;
use Illuminate\Http\Request;
use App\Classes\League;
use App\Classes\Team;
use Illuminate\Support\Facades\Session;

class BaseController extends Controller
{
    public function prepareLeague(Request $request)
    {
        $input = $request->all();

        // Create league object
        $league = new League();

        // Fill league teams
        foreach ($input['teams'] as $team) {
            $team = new Team($team);
            $league->addTeam($team);
        }

        // Generate fixture according to given teams
        $league->generateFixture();

        // Put league instance to session for further usage
        Session::put('league', $league);

        return response()->json(['status' => true]);
    }

    public function simulateWeek()
    {
        $league = Session::get('league');

        $gameSimulator = new GameSimulator();

        $i = 0;

        // Play this weeks matches
        $league->getGames()->each(function ($game) use (&$gameSimulator, &$i, $league) {
            if ($i == $league->getWeeklyMatchCount) {
                return;
            }

            if (!$game->isPlayed()) {
                $gameSimulator->playGame($game);

                $i++;
            }
        });

        return response()->json(['matches' => $league->getGames(), 'weeklyMatchCount' => $league->getWeeklyMatchCount()]);
    }

    public function simulateLeague()
    {

    }

    public function getFixture()
    {
        $league = Session::get('league');

        return response()->json(['teams' => $league->getTeams(), 'matches' => $league->getGames(), 'weeklyMatchCount' => $league->getWeeklyMatchCount()]);
    }
}
