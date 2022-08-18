@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')

<section class="content">
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="row text-right">
                 

                 
                    <!--<div class="col-12 text-right">-->
                    <!--    <a href="{{url('admins/point/create')}}" class="btn btn-primary btn-sm">-->
                    <!--        <i class="mdi mdi-plus-circle mr-2"></i>@lang('pages_names.add_points')</a>-->
                    <!--</div>-->
                </div>
            </div>

        <div id="js-point-partial-target">
                @if($results==null)
                <span style="text-align: center;font-weight: bold;"> @lang('view_pages.Loading')</span>
                @else
                <table class="table table-hover">
    <thead>
        <tr>
            <th> @lang('view_pages.s_no')</th>
              <th> @lang('pages_names.name_ar')</th>
                <th> @lang('pages_names.name_en')</th>
            <th> @lang('pages_names.no_point')</th>
            <th> @lang('pages_names.no_trip')</th>
            

            <th> @lang('view_pages.action')</th>
        </tr>
    </thead>

<tbody>
    

    @forelse($results as $key => $result)
        <tr>
            <td> {{ $loop->iteration }}</td>
                        <td>{{$result->name_ar }}</td>

                        <td>{{$result->name_en }}</td>

            <td>{{$result->no_point }}</td>
            <td>{{$result->no_trip }}</td>
                      
     
            <td>

            <div class="dropdown">
            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')
            </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{url('admins/level/update',$result->id)}}"><i class="fa fa-pencil"></i>@lang('view_pages.edit')</a>

                  <!--<a class="dropdown-item sweet-delete" href="{{url('admins/point/delete',$result->id)}}"><i class="fa fa-trash-o"></i>@lang('view_pages.delete')</a> -->
                </div>
            </div>

            </td>
        </tr>
    @empty
        <tr>
            <td colspan="11">
                <p id="no_data" class="lead no-data text-center">
                    <img src="{{asset('assets/img/dark-data.svg')}}" style="width:150px;margin-top:25px;margin-bottom:25px;" alt="">
                    <h4 class="text-center" style="color:#333;font-size:25px;">@lang('view_pages.no_data_found')</h4>
                </p>
            </td>
        </tr>
    @endforelse

    </tbody>
    </table>
    <ul class="pagination pagination-sm pull-right">
        <li>
            <a href="#">{{$results->links()}}</a>
        </li>
    </ul>



        </div>

        </div>
    </div>
</div>

@endif
@endsection

