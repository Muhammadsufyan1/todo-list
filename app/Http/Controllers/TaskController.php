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
        $tasks = Task::all();
        return view('list',compact('tasks'));
    }
    public function store(Request $request)
    {
        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
         $task->timezone = $request->timezone;
        $task->save();
        return redirect(route('tasklist'));
    }
    public function listRendor()
    {
        $tasks = Task::all();
        return $tasks;
    }
}
