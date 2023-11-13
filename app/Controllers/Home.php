<?php

namespace App\Controllers;

use App\Models\GameModel;

class Home extends BaseController
{
    public function index(): string
    {
        $games = new GameModel();
        
        $data['games'] = $games->findAll();

        return view('pages/home', $data);
    }
}
