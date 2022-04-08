<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function list()
    {
        return view('list');
    }
    public function store(Request $request)
    {
        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        $task->save();
        return redirect(route('tasklist'));
    }
    public function listRendor()
    {
        $timezone = request()->timezone;
        $tasks = Task::all();
        $view =  view('listpartial',compact('tasks','timezone'))->render();
        return $view;
    }
}
