@extends('layouts.layout')

@section('content')
    <!-- start content -->
    <div class="dashboard-title text-white bg-secondary">
        <h3>Categories List </h3>
        @if (auth()->user()->can('category_create'))
            <a href="{{ route('category.create') }}" class="btn btn-success">Create Category<i class="fas fa-plus"></i></a>
        @endif
    </div>
    <div class="dashboard-table py-0 bg-light">
        <div class="table-responsive">
            <table class="table display table-responsive-xl table-row-bordered gy-5" id="kt_datatable_dom_positioning">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">@lang('No')</th>
                        <th scope="col">@lang('Title')</th>
                        <th scope="col">@lang('Created At')</th>
                        <th scope="col">@lang('Control')</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    @foreach ($categories as $key => $category)
                        <tr>
                            <th class="align-middle" scope="row">{{ $key + 1 }}</th>
                            <td class="align-middle">{{ $category?->title }}</td>
                            <td class="align-middle">{{ $category?->created_at }}</td>

                            <td class="btn-table d-flex justify-content-center">
                                @if (auth()->user()->can('category_edit'))
                                    <a href='{{ route('category.edit', $category) }}'
                                        class="btn btn-icon  btn-active-color-success btn-sm me-1" data-toggle="tooltip"
                                        title=@lang('Edit Category')><i class="fa-regular fa-pen-to-square fs-2x"></i> </a>
                                @endif
                                @if (auth()->user()->can('category_destroy'))
                                    <x-delete route="{{ route('category.destroy', $category) }}" />
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
