<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTaskRequest;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function store( CreateTaskRequest $request){

        $user_id = Auth::user()->id;
        $validatedData = $request->validated();
        $validatedData['user_id'] = $user_id; // Set the authenticated user's ID
        $task = Task::create($validatedData);
        return response()->json($task, 201);
    }

    public function index(){

        $tasks= Auth::user()->tasks;
        return response()->json($tasks, 200);
    }

    public function getTasksByPriority(){

        $tasks = Auth::user()->tasks()->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")->get();
        return response()->json($tasks, 200);

    }

    public function getAllTasks(){

        $tasks= Task::all();
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

        $user_id = Auth::user()->id;
        $task = Task::findOrFail($id);

        if ($task->user_id !== $user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

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



    public function AddToFavorites($taskId){
        Task::findOrFail($taskId);
        Auth::user()->favoriteTasks()->syncWithoutDetaching($taskId);
        return response()->json(['message' => 'Task added to favorites'], 200);
    }

    public function RemoveFromFavorites($taskId){
         Task::findOrFail($taskId);
        Auth::user()->favoriteTasks()->detach($taskId);
        return response()->json(['message' => 'Task removed from favorites'], 200);

    }

    public function getFavoriteTasks(){
        $tasks = Auth::user()->favoriteTasks;
        return response()->json($tasks, 200);
    }





}
