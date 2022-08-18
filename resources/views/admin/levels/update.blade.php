@extends('admin.layouts.app')
@section('title', 'Main page')

@section('content')
{{-- {{session()->get('errors')}} --}}

    <!-- Start Page content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="box">

                        <div class="box-header with-border">
                            <a href="{{ url('admins/Levels') }}">
                                <button class="btn btn-danger btn-sm pull-right" type="submit">
                                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                    @lang('view_pages.back')
                                </button>
                            </a>
                        </div>

                        <div class="col-sm-12">

                            <form method="post" class="form-horizontal" action="{{ url('admins/level/update',$point->id) }}">
                                @csrf

                                   <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">@lang('pages_names.name_ar') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="no_point" name="name_ar"
                                              required  
                                              value="{{ $point->name_ar}}"
                                            >
                                        </div>
                                        
                                </div>

<div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">@lang('pages_names.name_en') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="price" name="name_en"
                                     required    value="{{$point->name_en}}"
                                                placeholder="@lang('view_pages.enter') @lang('pages_names.name_en')">
                                        </div>
                                    </div>
                                    </div>
                                    
                                    
                                 
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">@lang('pages_names.no_point') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" id="no_point" name="no_point"
                                              required  value="{{ $point->no_point}}"
                                                placeholder="@lang('view_pages.enter') @lang('pages_names.no_point')">
                                        </div>
                                        
                                </div>

<div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">@lang('pages_names.no_trip') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="price" name="no_trip"
                                     required    value="{{$point->no_trip}}"
                                                placeholder="@lang('view_pages.enter') @lang('pages_names.no_trip')">
                                        </div>
                                    </div>
                                    </div>
                                <div class="form-group">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-sm pull-right m-5" type="submit">
                                            @lang('view_pages.save')
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container -->
</div>
    <!-- content -->
@endsection
