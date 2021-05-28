<?php

namespace App\Http\Controllers;

use App\Priority;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TasksController extends Controller
{
    public function index()
    {
        View::share('pagename', 'task');

        $tasks = Task::orderBy('deadline')->orderBy('priority_code', 'desc')->get();
        $users = User::all();

        return view('tasks.index', compact('tasks', 'users'));
    }
    public function create()
    {
        $users = User::all();
        $priorities = Priority::all();

        return view('tasks.create', compact('users', 'priorities'));
    }

    public function store(Request $request)
    {
        $title = $request->input('title') ?? null;
        $description = $request->input('description');
        $deadline = date('Y-m-d', strtotime($request->input('deadline')));
        $priority = $request->input('priority');

        if(auth()->user()->can('add_any_task'))
        {
            $resp_id = (int)$request->input('assignee');
        }
        else
        {
            $resp_id = auth()->user()->id;
        }

        $messages = [
            'title.required' => 'Titlul trebuie completat',
            'deadline.required' => 'Deadline-ul trebuie completat',
            'min' => 'Titlul trebuie sa aiba cel putin 5 caractere',
            'after_or_equal' => 'Deadline-ul nu poate fi o data din trecut'
        ];

        $validatedData = $request->validate([
            'title' => 'required|min:3',
            'deadline' => 'required|date|after_or_equal:'. date('Y-m-d'),
        ], $messages);

        if($validatedData)
        {
            Task::create([
                'title' => $title,
                'description' => $description,
                'deadline' => $deadline,
                'priority_code' => $priority,
                'resp_id' => $resp_id,
                'owner_id' => auth()->user()->id,
            ]);

            session()->flash('task_created', 'Activitatea a fost creata.');
            return redirect()->route('home');
        }

        return redirect()->back()
            ->withErrors($validatedData)
            ->withInput();
    }

    public function delete($id)
    {
        Task::where('id', $id)->delete();

        return redirect()->back();
    }

    public function filter(Request $request)
    {
        $resp_id = (int)$request->input('resp_id');

        if($resp_id === 0)
        {
            $tasks = Task::orderBy('deadline')->orderBy('priority_code')->get();
        }
        else
        {
            $tasks = Task::where('resp_id', $resp_id)->orderBy('deadline')->orderBy('priority_code')->get();
        }

        return json_encode([
            'data' => View::make("tasks.partial")
                ->with('tasks', $tasks)
                ->render()
        ]);
    }
}
