@extends('layouts.layout')
@section('content')
    <div class="dashboard-title text-white bg-secondary">
        <h3> @lang('Statistics') </h3>
    </div>
    <div class="dashboard-table py-0 bg-light mt-2 pt-3 container">
        <div class="home">
            <div class="home-info">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4  ">
                            <div class="card  my-3 h-auto hoverable bg-gray-500 card-xl-stretch mb-xl-8 h-100 w-100"
                                >
                                <div class="card-header m-auto align-items-center">
                                    <h2 class="text-dark">Total Users</h3>
                                </div>
                                <div class="card-body  d-flex justify-content-center">
                                    <h1 class="card-title m-auto text-dark">{{$users}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4  ">
                            <div class="card  my-3 h-auto hoverable bg-gray-500  card-xl-stretch mb-xl-8 h-100 w-100">
                                <div class="card-header m-auto align-items-center">
                                    <h2 class="text-dark">Activated Users</h3>
                                </div>
                                <div class="card-body  d-flex justify-content-center">
                                    <h1 class="card-title m-auto text-dark">{{$activeUsers}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4  ">
                            <div class="card  my-3 h-auto hoverable bg-gray-500  card-xl-stretch mb-xl-8 h-100 w-100">
                                <div class="card-header m-auto align-items-center">
                                    <h2 class="text-dark">Un Activated Users</h3>
                                </div>
                                <div class="card-body  d-flex justify-content-center">
                                    <h1 class="card-title m-auto text-dark">{{$users-$activeUsers}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4  ">
                            <div class="card  my-3 h-auto hoverable bg-gray-500  card-xl-stretch mb-xl-8 h-100 w-100">
                                <div class="card-header m-auto align-items-center">
                                    <h2 class="text-dark">Total Providers</h3>
                                </div>
                                <div class="card-body  d-flex justify-content-center">
                                    <h1 class="card-title m-auto text-dark">{{$providers}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4  ">
                            <div class="card  my-3 h-auto hoverable bg-gray-500  card-xl-stretch mb-xl-8 h-100 w-100">
                                <div class="card-header m-auto align-items-center">
                                    <h2 class="text-dark">Activated Providers</h3>
                                </div>
                                <div class="card-body  d-flex justify-content-center">
                                    <h1 class="card-title m-auto text-dark">{{$activeProviders}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4  ">
                            <div class="card  my-3 h-auto hoverable bg-gray-500  card-xl-stretch mb-xl-8 h-100 w-100">
                                <div class="card-header m-auto align-items-center">
                                    <h2 class="text-dark">Un Activated Providers</h3>
                                </div>
                                <div class="card-body  d-flex justify-content-center">
                                    <h1 class="card-title m-auto text-dark">{{$providers-$activeProviders}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4  ">
                            <div class="card  my-3 h-auto hoverable bg-gray-500  card-xl-stretch mb-xl-8 h-100 w-100">
                                <div class="card-header m-auto align-items-center">
                                    <h2 class="text-dark">Total Roles</h3>
                                </div>
                                <div class="card-body  d-flex justify-content-center">
                                    <h1 class="card-title m-auto text-dark">{{$roles}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4  ">
                            <div class="card  my-3 h-auto hoverable bg-gray-500  card-xl-stretch mb-xl-8 h-100 w-100">
                                <div class="card-header m-auto align-items-center">
                                    <h2 class="text-dark">Total Movies</h3>
                                </div>
                                <div class="card-body  d-flex justify-content-center">
                                    <h1 class="card-title m-auto text-dark">{{$movies}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4  ">
                            <div class="card  my-3 h-auto hoverable bg-gray-500  card-xl-stretch mb-xl-8 h-100 w-100">
                                <div class="card-header m-auto align-items-center">
                                    <h2 class="text-dark">Total Catgories</h3>
                                </div>
                                <div class="card-body  d-flex justify-content-center">
                                    <h1 class="card-title m-auto text-dark">{{$categories}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


