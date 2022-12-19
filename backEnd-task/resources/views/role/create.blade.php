@extends('layouts.layout')

@section('content')
    <div class="dashboard-title text-white bg-secondary">
        @if (!isset($mode))
            <h3> Create Role </h3>
        @else
            <h3> Edit Role </h3>
        @endif
        @if (auth()->user()->can('role_view'))
        <a href="{{ route('role.index') }}" class="btn btn-primary">Back To Roles</a>
        @endif

    </div>
    <div class="dashboard-table py-0 bg-light">
        @if (!isset($mode))
            <form method="POST" id="FormCreateRole" action="{{ route('role.store') }}"
                class="card card-flush mt-3 bg-light shadow-sm">
            @else
                <form method="POST" id="FormCreateRole" action="{{ route('role.update', $role) }}"
                    class="card card-flush mt-3 bg-light shadow-sm">
                    @method('PUT')
        @endif
        <div class="form-row">
            @csrf
            <div class="form-group col-6">
                <x-input type="text" name="name" text="Role name *" value="{{ isset($mode) ? $role->name : ' ' }}" />
            </div>
            {{-- @dd() --}}
        </div>
        <div class="form-row">
                @foreach ($permissions->chunk(4) as $chunk)
                    <div class="form-group col-md-6 check-roles">
                        @foreach ($chunk as $permisssion)
                            <div class="col-md-9 custom-control custom-checkbox">
                                <input type="checkbox" name="permissions[]"
                                    {{ isset($mode) ? (in_array($permisssion->id, $rolePermission ?? []) ? 'checked' : '') : '' }}
                                    class="custom-control-input" id="{{ $permisssion->id . $permisssion->name }}"
                                    value="{{ $permisssion->id }}" />
                                <label class="custom-control-label text-dark"
                                    for="{{ $permisssion->id . $permisssion->name }}">{{ $permisssion->name }}</label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <div class="text-danger m-0 g-0">
                    @error('permissions')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" form="FormCreateRole"
                class="btn btn-success fs-4 w-25 p-0 g-0 mt-5 ">@lang('Save Data')</button>
        </div>
        </form>
    </div>

    <!-- start content -->
@endsection
