<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Unit;
use App\Models\Neighborhood;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::search($request)->paginate(20);

        return view('admin.tasks.index')
            ->withTasks($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tasks.create')
            ->withNeighborhoods(Neighborhood::all())
            ->withUnits(Unit::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task = Task::create($request->except(['_token']));

        return redirect()->route('admin.tasks.edit', $task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('admin.tasks.show')
            ->withTask($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('admin.tasks.edit')
            ->withTask($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $task->update($request->except(['_token', '_method']));

        return redirect()->route('admin.tasks.edit', $task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('admin.tasks.index');
    }
}
