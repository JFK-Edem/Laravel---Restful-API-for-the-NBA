<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;
use App\Http\Resources\TeamResource;
use App\Models\PivotTable;

class TeamsController extends Controller
{
    public function index () {
        $teams = Team::all();

        return response()->json([
                'success' => true,
                'data' => TeamResource::collection($teams)
        ]);
    }

    public function show (Team $team) {

        return response()->json([
            'success' => true,
            'data' => new TeamResource($team)
        ]);

    }


    public function store(Request $request, Team $team) {

        $player = Player::findOrFail($request->player);

       $team->players()->attach($player, ['joined_at' => now()]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy(Request $request, Team $team) {

        $player = Player::findOrFail($request->player);
       PivotTable::where('team_id', $team->id)->where('player_id',$player->id)->whereNull('left_at')->update(['left_at' => now()]);
        return response()->json([
            'success' => true,
        ]);
    }


}
