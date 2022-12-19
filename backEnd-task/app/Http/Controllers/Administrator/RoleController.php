<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role_view', ['only' => ['index', 'show']]);
        $this->middleware('permission:role_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role_destroy', ['only' => ['destroy']]);
    }
    public function index()
    {
        $roles = Role::whereNotIn('name', ['super', 'admin', 'user'])->get();
        return view('role.index', get_defined_vars());
    }

    public function show(Role $role)
    {
        return redirect()->route('role.index')->with('error', __('Can`t find this Role details'));
    }

    public function create()
    {
        $permissions = Permission::get();
        return view('role.create', get_defined_vars());
    }

    public function store(StoreRequest $storeRequest)
    {
        $data = $storeRequest->validated();
        // dd($data);
        $permissions = $data['permissions'];
        unset($data['permissions']);
        $data['guard_name'] = "dashboard";
        $role = Role::create($data);
        $role->permissions()->sync($permissions);
        if (auth()->user()?->can('role_view')) {
            $route = 'role.index';
        } else {
            $route = 'home';
        }
        return redirect()->route($route)->with('success', __('Data Saved Successfully'));
    }

    public function edit(Role $role)
    {
        $rolePermission = $role->permissions()->pluck('id')->toArray();
        $permissions = Permission::get();
        return view('role.create', ['mode' => "edit", "role" => $role, "rolePermission" => $rolePermission, 'permissions' => $permissions]);
    }

    public function update(Role $role, StoreRequest $storeRequest)
    {
        $data = $storeRequest->validated();
        $permissions = $data['permissions'];
        unset($data['permissions']);
        $data['guard_name'] = "dashboard";
        $role->update($data);
        $role->permissions()->sync($permissions);
        if (auth()->user()?->can('role_view')) {
            $route = 'role.index';
        } else {
            $route = 'home';
        }
        return redirect()->route($route)->with('success', __('Data Saved Successfully'));
    }

    public function destroy(Role $role)
    {
        $roleUsers = $role->users()->count();
        if ($roleUsers > 0) {
            $status = "error";
            $message = "failed during delete Role have users";
        } else {
            $role->delete();
            $status = "success";
            $message = "Deleted successfully";
        }
        return redirect()->back()->with($status, $message);
    }
}
