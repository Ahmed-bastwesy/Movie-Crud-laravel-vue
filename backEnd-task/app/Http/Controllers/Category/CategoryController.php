<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:category_view', ['only' => ['index', 'show']]);
        $this->middleware('permission:category_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category_destroy', ['only' => ['destroy']]);
    }
    public function index()
    {
        $categories = Category::get();
        return view('category.index', get_defined_vars());
    }

    public function show(Category $category)
    {
        return redirect()->route('category.index')->with('error', __('Can`t find this category details'));
    }

    public function create()
    {
        return view('category.create', get_defined_vars());
    }

    public function store(StoreRequest $storeRequest)
    {
        $data = $storeRequest->validated();

        $category = Category::create($data);
        if (auth()->user()?->can('category_view')) {
            $route = 'category.index';
        } else {
            $route = 'home';
        }
        return redirect()->route($route)->with('success', __('Data Saved Successfully'));
    }

    public function edit(Category $category)
    {
        return view('category.create', ['mode' => "edit", "category" => $category]);
    }

    public function update(Category $category, StoreRequest $storeRequest)
    {
        $data = $storeRequest->validated();
        $category->update($data);

        if (auth()->user()?->can('category_view')) {
            $route = 'category.index';
        } else {
            $route = 'home';
        }
        return redirect()->route($route)->with('success', __('Data Saved Successfully'));
    }

    public function destroy(Category $category)
    {
        $categoryMovies = $category->movies()->count();
        if ($categoryMovies > 0) {
            $status = 'error';
            $message = "failed during delete Category have movies";
        } else {
            $category->delete();
            $status = 'success';
            $message = "Deleted successfully";
        }
        return redirect()->back()->with($status, $message);
    }
}
