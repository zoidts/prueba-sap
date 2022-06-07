<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FormTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $taks = Task::where('user_id', Auth::user()->id)->with('Category')->get();
        $taksCount = $taks->count();
        return response()->json(['data'=> $taks, 'count'=> $taksCount], 200);
    }

    public function filter($id)
    {
         $taks = task::where('user_id', Auth::user()->id)
                      ->where('category_id', $id)
                      ->with('Category')
                      ->get();
         return response()->json($taks);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormTaskRequest $request)
    {
        $task = Task::create([
            'title' =>  $request->title,
            'description' =>  $request->description,
            'status' => $request->status,
            'level' => $request->level,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
        ]);

         return response()->json(['data' => $task], 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(FormTaskRequest $request, task $task)
    {
        $task-> update([
            'title' =>  $request->title,
            'description' =>  $request->description,
            'status' => $request->status,
            'level' => $request->level,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
        ]);

        return response()->json(['data' => $task], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(task $task)
    {
        $task->delete();
        return response()->json('Ok');
    }
}
