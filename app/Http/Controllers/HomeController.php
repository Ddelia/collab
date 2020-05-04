<?php

namespace App\Http\Controllers;

use App\Priority;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        View::share('pagename', 'dashboard');

        $tasks = Task::where('resp_id', auth()->user()->id)->orderBy('deadline')->orderBy('priority_code', 'desc')->get();
        $priorities = Priority::all();

        return view('dashboard.index', compact('tasks', 'priorities'));
    }

    public function filter(Request $request)
    {
        $deadline = (int)$request->input('deadline');
        $priority = (int)$request->input('priority');

        $deadline_filter = $deadline === 0 ? 'asc' : 'desc';

        if($priority === 0)
        {
            $tasks = Task::where('resp_id', auth()->user()->id)->orderBy('deadline', $deadline_filter)->orderBy('priority_code', 'desc')->get();
        }
        else
        {
            $tasks = Task::where('resp_id', auth()->user()->id)->where('priority_code', $priority)->orderBy('deadline', $deadline_filter)->get();
        }

        return json_encode([
            'data' => View::make("dashboard.partial")
                ->with('tasks', $tasks)
                ->render()
        ]);
    }
}
