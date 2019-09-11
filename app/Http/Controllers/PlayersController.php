<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Player;
use App\Http\Resources\Player as PlayerResource;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($q = null)
    {
        $players = Player::orderBy('created_at', 'desc');

        if ($q) {
            $players = $players->where('name', 'like', '%' . $q . '%')
            ->orWhere('age', $q);    
        }
        $players = $players->paginate(10);
        return PlayerResource::collection($players);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // create
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $player = new Player;

        $player->name = $request->name;
        $player->age = $request->age;

        if ($player->save()) {
            //return new PlayerResource($player);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $player = Player::findOrFail($id);
        return new PlayerResource($player);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        $player = Player::findOrFail($request->player_id);

        $player->name = $request->name;
        $player->age = $request->age;

        if ($player->save()) {
            return new PlayerResource($player);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $player = Player::findOrFail($id);
        if ($player->delete()) {
            return new PlayerResource($player);
        }
    }
}
