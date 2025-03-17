<?php

namespace App\Http\Controllers;

use App\Classes\GameSimulator;
use App\Classes\LeagueSimulator;
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
        foreach ($league->getGames() as $game) {
            if ($i == $league->getWeeklyMatchCount()) {
                break;
            }

            if (!$game->isPlayed()) {
                $gameSimulator->playGame($game);

                $i++;
            }
        }

        Session::put('league', $league);

        $leagueSimulator = new LeagueSimulator($league, 1000);
        $odds = $leagueSimulator->simulateChampionshipOdds();

        return response()->json(['teams' => $league->getTeams(), 'matches' => $league->getGames(), 'odds' => $odds, 'weeklyMatchCount' => $league->getWeeklyMatchCount()]);
    }

    public function simulateLeague()
    {

    }

    public function getFixture()
    {
        $league = Session::get('league');

        $leagueSimulator = new LeagueSimulator($league, 1000);
        $odds = $leagueSimulator->simulateChampionshipOdds();

        return response()->json(['teams' => $league->getTeams(), 'matches' => $league->getGames(), 'odds' => $odds, 'weeklyMatchCount' => $league->getWeeklyMatchCount()]);
    }

    public function resetLeague()
    {
        $league = Session::get('league');

        $teams = $league->getTeams();

        $league = new League();

        foreach ($teams as $team) {
            $league->addTeam(new Team($team->getName()));
        }

        $league->generateFixture();

        // Put league instance to session for further usage
        Session::put('league', $league);

        $leagueSimulator = new LeagueSimulator($league, 1000);
        $odds = $leagueSimulator->simulateChampionshipOdds();

        return response()->json(['teams' => $league->getTeams(), 'matches' => $league->getGames(), 'odds' => $odds, 'weeklyMatchCount' => $league->getWeeklyMatchCount()]);
    }
}
