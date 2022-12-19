@extends('layouts.layout')

@section('content')
    <!-- start content -->
    <div class="dashboard-title text-white bg-secondary">
        @if (request()->has('type'))
            <h3>{{ request('type') }} List </h3>
            @if (auth()->user()->can('user_create'))
                <a href="{{ route('user.create', ['type' => request('type')]) }}" class="btn btn-success">Create
                    {{ request('type') }}<i class="fas fa-plus"></i></a>
            @endif
        @endif
    </div>
    <div class="dashboard-table py-0 bg-light">
        <div class="table-responsive">
            <table class="table display table-responsive-xl table-row-bordered gy-5" id="kt_datatable_dom_positioning">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">@lang('No')</th>
                        <th scope="col">@lang('Name')</th>
                        <th scope="col">@lang('Email')</th>
                        <th scope="col">@lang('BirthDate')</th>
                        @if (request('type') == 'Providers')
                            <th scope="col">@lang('Role')</th>
                        @endif
                        <th scope="col">@lang('Status')</th>
                        <th scope="col">@lang('Control')</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    @if (request()->has('type'))
                        @foreach ($users as $key => $user)
                            <tr>
                                <th class="align-middle" scope="row">{{ $key + 1 }}</th>
                                <td class="align-middle">{{ $user?->name }}</td>
                                <td class="align-middle">{{ $user?->email }}</td>
                                <td class="align-middle">{{ $user?->birthdate }}</td>
                                @if (request('type') == 'Providers')
                                <th class="align-middle">{{$user?->roles()->pluck('name')}}</th>
                                 @endif
                                <td class="align-middle">{{ $user?->active? "active" : "deActive"}}</td>
                                <td class="btn-table d-flex justify-content-center">
                                    @if (auth()->user()->can('user_edit'))
                                        <a href='{{ route('user.edit',[$user,'type'=>request('type')]) }}'
                                            class="btn btn-icon  btn-active-color-success btn-sm me-1" data-toggle="tooltip"
                                            title=@lang('Edit User')><i class="fa-regular fa-pen-to-square fs-2x"></i> </a>
                                    @endif
                                    @if (auth()->user()->can('user_destroy'))
                                        <form class="inline-block p-0" action="{{ route('user.toggle',$user) }}"
                                            method="POST">
                                            @csrf
                                            @if ($user->active)
                                                <button type="submit"
                                                    class=" btn btn-icon  btn-active-color-danger btn-sm me-1 "><i
                                                        class="fa-regular fa-circle-xmark fs-2x"></i></button>
                                            @else
                                                <button type="submit"
                                                    class=" btn btn-icon  btn-active-color-success btn-sm me-1 "><i
                                                        class="fa-regular fa-circle-check fs-2x"></i></button>
                                            @endif
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @endif
                </tbody>
            </table>
        </div>
    </div>


    <!-- start content -->
@endsection
