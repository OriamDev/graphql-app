<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function show($categoryId): CategoryResource
    {
        $category = Category::with('products')->find($categoryId);
        return CategoryResource::make($category);
    }

    public function index(): CategoryCollection
    {
        return CategoryCollection::make(Category::paginate(
            $perPage = request('page.size', 5),
            $columns = ['*'],
            $pageName = 'page[number]',
            $page = request('page.number', 1)
        ));
    }

    public function create(Request $request): CategoryResource
    {
        $request->validate([
            'data.attributes.name' => 'required|unique:categories,name'
        ]);

        $category = Category::create($request->input('data.attributes'));
        return CategoryResource::make($category);
    }

    public function update(Request $request, Category $category): CategoryResource
    {
        $request->validate([
            'data.attributes.name' => 'required|unique:categories,name,'.$category->id
        ]);

        $category->update($request->input('data.attributes'));
        return CategoryResource::make($category);
    }

    public function destroy(Category $category): Response
    {
        $category->delete();
        return response()->noContent();
    }
}
