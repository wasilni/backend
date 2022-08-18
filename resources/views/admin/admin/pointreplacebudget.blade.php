@extends('admin.layouts.app')
@section('title', 'Main page')

@section('content')


<div class="box-body no-padding">
    <div class="table-responsive">
      <table class="table table-hover">
    <thead>
    <tr>


    <th> @lang('view_pages.s_no')
    <span style="float: right;">

    </span>
    </th>

    <th> @lang('view_pages.no_point')
    <span style="float: right;">
    </span>
    </th>
    <th> @lang('view_pages.price')
    <span style="float: right;">
    </span>
    </th>
  
    <th> @lang('view_pages.action')
    <span style="float: right;">
    </span>
    </th>
    </tr>
    </thead>
    <tbody>
    @if(count($point)<1)
    <tr>
        <td colspan="11">
        <p id="no_data" class="lead no-data text-center">
        <img src="{{asset('assets/img/dark-data.svg')}}" style="width:150px;margin-top:25px;margin-bottom:25px;" alt="">
     <h4 class="text-center" style="color:#333;font-size:25px;">@lang('view_pages.no_data_found')</h4>
 </p>
    </tr>
    @else


    @foreach($point as $pointitem)

    <tr>
     <td>{{ $loop->iteration }}</td>
    <td> {{ $pointitem->no_point}}</td>
    <td>{{$pointitem->price}}</td>
    <td><button class="btn btn-success btn-sm">Active</button></td>
    <td><button class="btn btn-danger btn-sm">InActive</button></td>
    <td>

    <div class="dropdown">
    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')
    </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="">
            <i class="fa fa-pencil"></i>@lang('view_pages.edit')</a>

            <a class="dropdown-item" href="">
            <i class="fa fa-dot-circle-o"></i>@lang('view_pages.inactive')</a>
            <a class="dropdown-item" href="">
            <i class="fa fa-dot-circle-o"></i>@lang('view_pages.active')</a>
          
          
        </div>
    </div>

    </td>
    </tr>
    @endforeach
    @endif
    </tbody>
    </table>
    <div class="text-right">
    <span  style="float:right">
    {{$point->links()}}
    </span>
    </div>
    </div>
    </div>
    @endsection

    
