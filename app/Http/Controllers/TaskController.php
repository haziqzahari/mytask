<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Task;
use App\Models\TaskTag;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //Eager Loading
        $tasks = Task::with('user')->get(); //SELECT * from tasks;
        // $tasks = Task::get(); //SELECT * from tasks;

        return response()->json($tasks);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Create task";

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'is_completed' => 'required',
            'tags' => 'array'
        ]);

        $params = $request->only([
            'title',
            'description',
            'user_id',
            'due_date',
            'is_completed'
        ]);

        try{
            $task = Task::create(
                $params
            );

            if($request->has('tags')){
                collect($request->post('tags'))->each(function($tag) use($task){
                    TaskTag::create([
                        'task_id' => $task->id,
                        'tag_id' => Tag::findOrFail($tag)->id
                    ]);
                });
            }
        }catch (Exception $th)
        {
            return response()->json($th->getMessage());
        }

        $task->load([
            'user',
            'tags'
        ]);

        return response()->json($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);

        //Lazy Loading
        $task->load('user');

        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string',
            'is_completed' => 'required'
        ]);

        $params = $request->only([
            'title',
            'description',
            'user_id',
            'due_date',
            'is_completed'
        ]);

        try{
            $task = Task::findOrFail($id);

            $task->fill(
                $params
            );

            $task->save();

            if($request->has('tags')){

                TaskTag::where('task_id', $id)->delete();

                collect($request->post('tags'))->each(function($tag) use($task){
                    TaskTag::create([
                        'task_id' => $task->id,
                        'tag_id' => Tag::findOrFail($tag)->id
                    ]);
                });
            }

        }catch (Exception $th)
        {
            return response()->json($th->getMessage());
        }

        $task->load(['user', 'tags']);

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{

            $task = Task::findOrFail($id);
            TaskTag::where('task_id', $task->id)->delete();

            $task->delete();


            return response()->json('Sucessfully removed task.');
        }catch (Exception $th)
        {
            return response()->json($th->getMessage());
        }
    }
}
