<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TeamController extends Controller
{
    public function index()
    {
        View::share('pagename', 'team');

        $users = User::all();

        return view('team.index', compact('users'));
    }
}
