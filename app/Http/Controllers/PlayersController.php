<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use App\Http\Requests\PlayerRequest;

class PlayersController extends Controller
{
    public function index () {
        $players = Player::all();
        //return $players;

        return response()->json([
            'success' => true,
            'data'=> $players
        ]);
    }

    public function store(PlayerRequest $request) {

        $player = Player::create ([
            'name' => $request->get('name'),
            'photo' => $request->get('photo'),
            'age' => $request->get('age'),
            'team' => $request->get('team'),
            'country' => $request->get('country')
        ]);

        return response()->json([
            'success' => true,
            'data'=> $player
        ], 201);
    }

    public function update (PlayerRequest $request,$id) {

        $player = Player::findOrFail($id);

        $success =$player->update([
            'name' => $request->get('name'),
            'photo' =>$request->get('photo'),
            'age' => $request->get('age'),
            'team' => $request->get('team'),
            'country' => $request->get('country')
        ]);

         return response()->json([
             'success' => $success,
             'data' => $player
         ]);
    }


    public function destroy(Player $player) {
        $success = $player->delete();

        return [
            'success' => $success
        ];
    }
}
