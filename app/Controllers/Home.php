<?php

namespace App\Controllers;

use App\Models\GameModel;
use App\Models\TopupModel;

class Home extends BaseController
{
    public function index(): string
    {
        $games = new GameModel();

        $data['games'] = $games->findAll();

        return view('pages/home', $data);
    }

    public function show($id = null)
    {
        $games = new GameModel();
        $topups = new TopupModel();

        $data['game'] = $games->where('slug', $id)->first();
        $data['topups'] = $topups->where('game_id', $data['game']['game_id'])->findAll();

        return view('pages/detail_game', $data);
    }

    
}
