<?php

namespace Database\Seeders;

use App\Enums\DashboardPermissionsEnum;
use App\Enums\RoleEnum;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setPermissions();
        $this->setRoles();
        $this->setUsers();
    }

    private function setUsers(){
        Auth::shouldUse('dashboard');
        tap(User::updateOrCreate(['email' => 'admin@admin.com'], [
            'name'      => 'Super Admin',
            'email'     => 'admin@admin.com',
            'active'    => true,
            'birthdate' => Carbon::now(),
            'password'  => bcrypt('12345678'),
        ]))->assignRole([
            RoleEnum::admin()->value,
            RoleEnum::super()->value,
        ]);
    }

    private function setRoles(){
        Role::query()->delete();
        $roles = collect(RoleEnum::toArray())
            ->transform(fn ($i) => ['name' => $i, 'guard_name' => 'dashboard'])
            ->toArray();
        Role::insert($roles);

        Role::findByName('super', 'dashboard')
            ->permissions()->sync(Permission::where('guard_name', 'dashboard')->pluck('id'));
    }

    private function setPermissions(){
        DB::table('role_has_permissions')->delete();
        DB::table('permissions')->delete();
        $permissions = collect(DashboardPermissionsEnum::toArray())
            ->transform(fn ($i) => ['name' => $i, 'guard_name' => 'dashboard'])
            ->toArray();

        Permission::insert($permissions);
    }

}
