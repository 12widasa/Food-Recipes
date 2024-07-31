<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\Api\CategoryResource;

class CategoryController extends Controller
{
    //index, mengambil semua data category yang akan ditampilkan di halaman depan
    public function index ()
    {
        // $categories = Category::with('recipes')->withCount('recipes')->get();
        $categories = Category::withCount('recipes')->get();
        return CategoryResource::collection($categories);
    }


    //show, menampilkan detail category
    public function show(Category $category)
    {
        $category->load(['recipes.category', 'recipes.author']);
        $category->loadCount('recipes');
        return new CategoryResource($category);
    }
}
