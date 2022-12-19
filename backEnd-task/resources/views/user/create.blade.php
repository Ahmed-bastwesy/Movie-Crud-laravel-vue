@extends('layouts.layout')

@section('content')
    <div class="dashboard-title text-white bg-secondary">
        @if (!isset($mode))
            <h3> Create {{ request('type') }} </h3>
        @else
            <h3> Edit {{ $type }} </h3>
        @endif
        @if (auth()->user()->can('user_view'))
            <a href="{{ route('user.index', ['type' => request('type')]) }}" class="btn btn-primary">Back To
                {{ request('type') }}</a>
        @endif

    </div>
    <div class="dashboard-table py-0 bg-light">
        @if (!isset($mode))
            <form method="POST" id="FormCreateUser" action="{{ route('user.store', ['type' => request('type')]) }}"
                class="card card-flush mt-3 bg-light shadow-sm">
            @else
                <form method="POST" id="FormCreateUser" action="{{ route('user.update', [$user, 'type' => $type]) }}"
                    class="card card-flush mt-3 bg-light shadow-sm">
                    @method('PUT')
        @endif
        <div class="form-row">
            @csrf
            <div class="form-group col-6">
                <x-input type="text" name="name" text="User name *" value="{{ isset($mode) ? $user->name : ' ' }}" />
            </div>

            <div class="form-group col-6">
                <x-input type="email" name="email" text="email *" value="{{ isset($mode) ? $user->email : ' ' }}" />
            </div>

            <div class="form-group col-6">
                <x-input type="date" name="birthdate" text="Birth Date *"
                    value="{{ isset($mode) ? $user->birthdate : ' ' }}" />
            </div>

            <div class="form-group col-6">
                <x-input type="password" name="password" text="Password *" />
            </div>

            <div class="form-group col-6">
                <x-input type="password" name="password_confirmation" text="Confirm Password *" />
            </div>
            @if (request('type') == 'Providers' || (isset($type) && $type == 'Providers'))
                <div class="form-group col-6">
                    <label class="fieldlabels text-dark"> roles * </label><br>
                    <select class="form-select" name="roles" data-control="select2" data-placeholder="Select an option">
                        <option></option>
                        @foreach ($roles as $role)
                            <option value="{{ $role?->id }}"
                                {{ isset($mode)? ($user->roles()->get()->last()->id == $role->id? 'selected': ''): ' ' }}>
                                {{ $role?->name }}</option>
                        @endforeach
                    </select>
                    <div class="text-danger mt-4">
                        @error('roles')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            @endif

        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" form="FormCreateUser"
                class="btn btn-success fs-4 w-25 p-0 g-0 mt-5 ">@lang('Save Data')</button>
        </div>
        </form>
    </div>

    <!-- start content -->
@endsection
