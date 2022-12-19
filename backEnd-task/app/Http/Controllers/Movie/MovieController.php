<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\StoreRequest;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:movie_view', ['only' => ['index', 'show']]);
        $this->middleware('permission:movie_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:movie_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:movie_destroy', ['only' => ['destroy']]);
    }
    public function index()
    {
        $categories = Category::get();
        $movies = Movie::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('title') && !empty(request('title'))) {
                $movies->where("title", 'like', "%" . request('title') . "%");
            }

            if (request()->has('category_id') && !empty(request('category_id'))) {
                $movies->whereHas('category', function ($query) {
                    $query->where('id', request('category_id'));
                });
            }
            if (request()->has('rate') && !is_null(request('rate'))) {
                $movies->where('rate', 'like', request('rate'));
            }
        }
        $movies = $movies->orderBy('id', "DESC")->paginate();

        return view('movie.index', get_defined_vars());
    }

    public function show(Movie $movie)
    {
        return redirect()->route('movie.index')->with('error', __('Can`t find this movie details'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('movie.create', get_defined_vars());
    }

    public function store(StoreRequest $storeRequest)
    {
        $data = $storeRequest->validated();
        if (request()->has('image')) {
            $data['image']  = imageUpload($storeRequest->image, 'movies');
        }
        $movie = Movie::create($data);
        if (auth()->user()?->can('movie_view')) {
            $route = 'movie.index';
        } else {
            $route = 'home';
        }
        return redirect()->route($route)->with('success', __('Data Saved Successfully'));
    }

    public function edit(Movie $movie)
    {
        $categories = Category::get();
        return view('movie.create', ['mode' => "edit", "categories" => $categories, "movie" => $movie]);
    }

    public function update(Movie $movie, StoreRequest $storeRequest)
    {
        $data = $storeRequest->validated();
        if (request()->has('image')) {
            $data['image']  = imageUpload($storeRequest->image, 'movies', [], false, true, $movie->image);
        } else {
            unset($data['image']);
        }
        $movie->update($data);
        if (auth()->user()?->can('movie_view')) {
            $route = 'movie.index';
        } else {
            $route = 'home';
        }
        return redirect()->route($route)->with('success', __('Data Saved Successfully'));
    }

    public function destroy(Movie $movie)
    {
        DeleteImage($movie->image);
        $movie->delete();
        $status = "success";
        $message = "Deleted successfully";
        return redirect()->back()->with($status, $message);
    }
}
