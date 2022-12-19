@extends('layouts.layout')

@section('content')
    <!-- start content -->
    <div class="dashboard-title text-white bg-secondary">
        <h3>Movies List </h3>
        @if (auth()->user()->can('movie_create'))
            <a href="{{ route('movie.create') }}" class="btn btn-success">Create Movie<i class="fas fa-plus"></i></a>
        @endif
    </div>

    <div class="card-header border-bottom d-flex justify-content-between align-items-baseline mt-2 bg-gray-300">
        <h4 class="card-title mx-3 align-middle">@lang('Advanced Search')</h4>
        <div class="card-title">
            <button class="btn btn-icon  btn-active-color-success btn-round waves-effect waves-float waves-light" title="{{__("Search")}}" style="padding: 10px 25px;" type="button" onclick="$('.dt_adv_search').submit()"><i class="fa-solid fa-database fs-2x"></i></button>
            <button class="btn btn-icon  btn-active-color-warning btn-round waves-effect waves-float waves-light form-reset" title="{{__("Reset Search Data")}}" style="padding: 10px 25px;" type="button" onclick="resetForm();"><i class="fa-solid fa-filter-circle-xmark fs-2x"></i></button>
        </div>
    </div>
    <!--Search Form -->
    <div class="card-body">
        <form class="dt_adv_search card card-flush mt-3 bg-light shadow-sm" method="GET">
            <div class="row g-1 mb-md-1">
                <div class="col-md-4">
                    <label class="form-label">@lang('Tile')</label>
                    <input type="text" name="title" class="form-control dt-input" value="{{old('title', request('title'))}}" data-column="1" placeholder="{{__('Tile')}}" data-column-index="0" />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="select2-basic2">@lang('Category')</label>
                    <select class="form-select" name="category_id" data-control="select2" data-placeholder="Select an option">
                        <option value="">@lang("Choose")</option>
                        @foreach($categories as $category)
                        <option value="{{$category?->id}}" @if(!is_null(request('category_id')) && request('category_id') == $category?->id) selected @endif>{{$category?->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">@lang('Rate')</label>
                    <input type="text" name="rate" pattern ="/^(?:[1-9]\d*|0)?(?:\.\d+)?$/m" class="form-control dt-input " value="{{old('rate', request('rate'))}}" data-column="1" placeholder="{{__('Rate')}}" data-column-index="0" />
                </div>
            </div>
            <input type="hidden" name="filter" value="1"/>
        </form>
    </div>

    <div class="dashboard-table py-0 bg-light">
        <div class="table-responsive">
            <table class="table display table-responsive-xl table-row-bordered gy-5" id="kt_datatable_dom_positioning">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">@lang('No')</th>
                        <th scope="col">@lang('Title')</th>
                        <th scope="col">@lang('Description')</th>
                        <th scope="col">@lang('Rate')</th>
                        <th scope="col">@lang('Category')</th>
                        <th scope="col">@lang('image')</th>
                        <th scope="col">@lang('Created At')</th>
                        <th scope="col">@lang('Control')</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    @foreach ($movies as $key => $movie)
                        <tr>
                            <th class="align-middle" scope="row">{{ $key + 1 }}</th>
                            <td class="align-middle">{{ $movie?->title }}</td>
                            <td class="align-middle">{{ $movie?->description }}</td>
                            <td class="align-middle">{{ $movie?->rate }}</td>
                            <td class="align-middle">{{ $movie?->category?->title }}</td>
                            <td class="align-middle"> <img src="{{ $movie?->image_path }}"> </td>
                            <td class="align-middle">{{ $movie?->created_at }}</td>

                            <td class=" align-middle">
                                @if (auth()->user()->can('movie_edit'))
                                    <a href='{{ route('movie.edit', $movie) }}'
                                        class="btn btn-icon  btn-active-color-success btn-sm me-1" data-toggle="tooltip"
                                        title=@lang('Edit Movie')><i class="fa-regular fa-pen-to-square fs-2x"></i> </a>
                                @endif
                                @if (auth()->user()->can('movie_destroy'))
                                    <x-delete route="{{ route('movie.destroy', $movie) }}" />
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
