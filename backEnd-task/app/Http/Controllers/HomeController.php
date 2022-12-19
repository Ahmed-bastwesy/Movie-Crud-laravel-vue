<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function index(){

        $users = User::whereHas('roles', function($q){
                $q->where('name', 'user');
            })->orWhereDoesntHave('roles')->count();
        $activeUsers = User::whereActive(1)->whereHas('roles', function($q){
                            $q->where('name', 'user');
                        })->orWhereDoesntHave('roles')->count();
        $providers = User::whereHas('roles', function($q){
                $q->where('name', 'admin');
            })->count();
        $activeProviders = User::whereActive(1)->whereHas('roles', function($q){
                $q->where('name', 'admin');
            })->count();
        $categories = Category::count();
        $movies = Movie::count();
        $roles = Role::count();
        return view('home', get_defined_vars());
    }
}
