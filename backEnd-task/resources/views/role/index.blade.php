@extends('layouts.layout')

@section('content')
    <!-- start content -->
    <div class="dashboard-title text-white bg-secondary">
        <h3>Roles List </h3>
        @if (auth()->user()->can('role_create'))
            <a href="{{ route('role.create') }}" class="btn btn-success">Create Role<i class="fas fa-plus"></i></a>
        @endif
    </div>
    <div class="dashboard-table py-0 bg-light">
        <div class="table-responsive">
            <table class="table display table-responsive-xl table-row-bordered gy-5" id="kt_datatable_dom_positioning">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">@lang('No')</th>
                        <th scope="col">@lang('Name')</th>
                        <th scope="col">@lang('Created At')</th>
                        <th scope="col">@lang('Control')</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    @foreach ($roles as $key => $role)
                        <tr>
                            <th class="align-middle" scope="row">{{ $key + 1 }}</th>
                            <td class="align-middle">{{ $role?->name }}</td>
                            <td class="align-middle">{{ $role?->created_at }}</td>

                            <td class="btn-table d-flex justify-content-center">
                                @if (auth()->user()->can('role_edit'))
                                    <a href='{{ route('role.edit', $role) }}'
                                        class="btn btn-icon  btn-active-color-success btn-sm me-1" data-toggle="tooltip"
                                        title=@lang('Edit Role')><i class="fa-regular fa-pen-to-square fs-2x"></i> </a>
                                @endif
                                @if (auth()->user()->can('role_destroy'))
                                    <x-delete route="{{ route('role.destroy', $role) }}" />
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- start content -->
@endsection
