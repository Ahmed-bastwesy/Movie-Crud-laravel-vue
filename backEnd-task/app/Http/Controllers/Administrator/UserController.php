<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user_view', ['only' => ['index', 'show']]);
        $this->middleware('permission:user_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user_destroy', ['only' => ['destroy']]);
    }
    public function index()
    {
        $users = User::get();
        if (request('type') == 'Users') {
            $users = User::where('id', '!=', auth()->user()->id)->whereHas('roles', function ($q) {
                $q->where('name', 'user');
            })->orWhereDoesntHave('roles')->get();
        } else {
            $users = User::where('id', '!=', auth()->user()->id)->whereHas('roles', function ($q) {
                $q->where('name', 'admin');
            })->get();
        }
        return view('user.index', get_defined_vars());
    }

    public function show(User $user)
    {
        return redirect()->route('user.index')->with('error', __('Can`t find this user details'));
    }

    public function create()
    {
        $roles = Role::whereNotIn('name', ['super', 'admin', 'user'])->get();
        return view('user.create', get_defined_vars());
    }

    public function store(StoreRequest $storeRequest)
    {
        $data = $storeRequest->validated();
        $data['password'] = bcrypt($data['password']);
        $roles = isset($data['roles']) ? [$data['roles']] : [];
        unset($data['roles']);
        $user = User::create($data);
        if (request('type') == 'Providers') {
            array_push($roles, 'admin');
        } else {
            $roles = 'user';
        }
        $user->assignRole($roles);
        if (auth()->user()?->can('user_view')) {
            $route = 'user.index';
            $parameters = ["type" => request('type')];
        } else {
            $route = 'home';
            $parameters = [];
        }
        return redirect()->route($route, $parameters)->with('success', __('Data Saved Successfully'));
    }

    public function edit(User $user)
    {
        if($user->hasRole("super")){
            $route = 'user.index';
            $parameters = ["type" => request('type')];
            return redirect()->route($route, $parameters)->with('error', __('cant edit super admin '));
        }
        $roles = Role::whereNotIn('name', ['super', 'admin', 'user'])->get();
        return view('user.create', ['mode' => "edit", 'roles' => $roles, "user" => $user, 'type' => request('type')]);
    }

    public function update(User $user, StoreRequest $storeRequest)
    {
        $data = $storeRequest->validated();
        $data['password'] = isset($data['password']) ? bcrypt($data['password']) : $user->password;
        $roles = isset($data['roles']) ? [$data['roles']] : [];
        unset($data['roles']);
        $user->update($data);
        if (request('type') == 'Providers') {
            array_push($roles, 'admin');
        } else {
            $roles = 'user';
        }
        $user->syncRoles($roles);
        if (auth()->user()?->can('user_view')) {
            $route = 'user.index';
            $parameters = ["type" => request('type')];
        } else {
            $route = 'home';
            $parameters = [];
        }
        return redirect()->route($route, $parameters)->with('success', __('Data Saved Successfully'));
    }

    public function toggle(User $user)
    {
        $user->update([
            'active' => !$user->active
        ]);
        return redirect()->back();
    }
}
