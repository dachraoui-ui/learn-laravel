<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTaskRequest;

class TaskController extends Controller
{
    public function store( CreateTaskRequest $request){

        $task = Task::create($request->validated());
        return response()->json($task, 201);
    }

    public function index(){
        $tasks = Task::all();
        return response()->json($tasks, 200);
    }

    public function show($id){
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return response()->json($task, 200);
    }

    public function destroy($id){
        $task = Task::findOrFail($id);
        if (!$task){
            return response()->json(['message' => 'Task not found'], 404);
        }
        else{
            $task->delete();
            return response()->json(['message' =>'Task deleted'], 204);
        }
    }
    public function update(Request $request, $id){
        $task = Task::findOrFail($id);
        $valid = $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'priority' => ['sometimes', 'integer', 'min:1', 'max:5'],
        ]);

        $task->update($valid);
        return response()->json($task, 200);
    }

    public function getTaskUser($id){
        $user = Task::findOrFail($id)->user;
        return response()->json($user, 200);
    }



    public function addCategoriesToTask(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->categories()->attach($request->category_id);
        return response()->json(['message' => 'Category added to task'], 200);
    }


    public function getTaskCategories($taskId)
    {
        $categories = Task::findOrFail($taskId)->categories;
        return response()->json($categories, 200);
    }

    


}
