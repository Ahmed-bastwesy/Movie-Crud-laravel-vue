@extends('layouts.layout')

@section('content')
    <div class="dashboard-title text-white bg-secondary">
        @if (!isset($mode))
            <h3> Create Movie </h3>
        @else
            <h3> Edit Movie </h3>
        @endif
        @if (auth()->user()->can('movie_view'))
        <a href="{{ route('movie.index') }}" class="btn btn-primary">Back To Movies</a>
        @endif

    </div>
    <div class="dashboard-table py-0 bg-light">
        @if (!isset($mode))
            <form method="POST" id="FormCreateMovie" enctype="multipart/form-data" action="{{ route('movie.store') }}"
                class="card card-flush mt-3 bg-light shadow-sm">
            @else
                <form method="POST" id="FormCreateMovie" enctype="multipart/form-data" action="{{ route('movie.update',$movie) }}"
                    class="card card-flush mt-3 bg-light shadow-sm">
                    @method('PUT')
        @endif
        <div class="form-row">
            @csrf
            <div class="form-group col-6">
                <x-input type="text" name="title" text="Movie Title *" value="{{ isset($mode) ? $movie?->title : ' ' }}" />
            </div>

            <div class="form-group col-6">
                <x-input type="text" name="description" text="Movie Description *" value="{{ isset($mode) ? $movie?->description : ' ' }}" />
            </div>

            <div class="form-group col-6">
                <x-input type="text" name="rate" text="Movie Rate *" value="{{ isset($mode) ? $movie?->rate : ' ' }}" />
            </div>

            <div class="form-group col-6">
                <label class="fieldlabels text-dark"> Category * </label><br>
                <select class="form-select" name="category_id" data-control="select2" data-placeholder="Select an option">
                    <option></option>
                    @foreach($categories as $category)
                    <option value="{{$category?->id}}" {{ isset($mode)? ($movie->category?->id==$category->id ?"selected":''): ' ' }} >{{$category?->title}}</option>
                    @endforeach
                </select>
                <div class="text-danger mt-4">
                    @error('category_id')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form-group col-12">
                <label class="text-dark">
                    @lang('Movie Image')
                </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">{{__('Upload')}}</span>
                    </div>
                    <div class="custom-file mt-2">
                        <input type="file" name="image" accept=".jpeg, .png, .jpg, .gif, .svg" class="form-control  @error('image') is-invalid @enderror" id="inputGroupFile01">
                        <x-input-error default="Please enter the field." name="image" />
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" form="FormCreateMovie"
                class="btn btn-success fs-4 w-25 p-0 g-0 mt-5 ">@lang('Save Data')</button>
        </div>
        </form>
    </div>
@endsection
