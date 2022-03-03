<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Imports\TeamsImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\PlayerResource;
use App\Http\Resources\PlayerCollection;
use App\Http\Requests\PlayerUpdateRequest;
use App\Imports\PlayersImport;

class PlayersController extends Controller
{
    public function index () {

        $players = Player::paginate(5);

        return new PlayerCollection($players);

    }

    public function show (Player $player) {

        return response()->json([
            'success' => true,
            'data' => new PlayerResource($player)
        ]);

    }

    public function store(PlayerRequest $request) {

        $player = Player::create ($request->validated());

        return response()->json([
            'success' => true,
            'data'=> new PlayerResource($player)
        ], 201);
    }

    public function update (PlayerUpdateRequest $request, Player $player) {

        //
        $success = $player->update($request->validated());

         return response()->json([
             'success' => $success,
             'data' => new PlayerResource($player)
         ]);
    }


    public function destroy(Player $player) {

        // soft deletes

        $success = $player->delete();

        return [
            'success' => $success
        ];
    }

        public function importTeam()
        {
           $success = Excel::import(new TeamsImport, storage_path('nba_teams_19.csv'));

            return [
                'success'=> $success
             ];
        }

        public function importPlayer()
        {
            $success = Excel::import(new PlayersImport, storage_path('players-data.csv'));

            return [
                'success'=> $success
            ];

        }

}
