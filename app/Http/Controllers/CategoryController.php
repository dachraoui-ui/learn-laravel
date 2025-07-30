<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CreateCategoryRequest;

class CategoryController extends Controller
{
    public function store(CreateCategoryRequest $request){
        $category = Category::create($request->validated());
        return response()->json($category, 201);
    }

    public function getCategorieTasks($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $tasks = $category->tasks;
        return response()->json($tasks, 200);
    }

}
