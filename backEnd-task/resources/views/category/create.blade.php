@extends('layouts.layout')

@section('content')
    <div class="dashboard-title text-white bg-secondary">
        @if (!isset($mode))
            <h3> Create Category </h3>
        @else
            <h3> Edit Category </h3>
        @endif
        @if (auth()->user()->can('category_view'))
            <a href="{{ route('category.index') }}" class="btn btn-primary">Back To Categories</a>
        @endif

    </div>
    <div class="dashboard-table py-0 bg-light">
        @if (!isset($mode))
            <form method="POST" id="FormCreateCategory" action="{{ route('category.store') }}"
                class="card card-flush mt-3 bg-light shadow-sm">
            @else
                <form method="POST" id="FormCreateCategory" action="{{ route('category.update', $category) }}"
                    class="card card-flush mt-3 bg-light shadow-sm">
                    @method('PUT')
        @endif
        <div class="form-row">
            @csrf
            <div class="form-group col-6">
                <x-input type="text" name="title" text="Category Title *"
                    value="{{ isset($mode) ? $category?->title : ' ' }}" />
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" form="FormCreateCategory"
                class="btn btn-success fs-4 w-25 p-0 g-0 mt-5 ">@lang('Save Data')</button>
        </div>
        </form>
    </div>
@endsection
