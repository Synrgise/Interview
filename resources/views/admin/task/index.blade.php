@extends('admin.layouts.main')
@section('content')
<a href="{{route('admin.task.create')}}" class="col-md-2 offset-md-11 btn btn-info">create</a>
@if(Session::has('success'))
<div class="alert alert-success suc_msg">{{Session::get('success')}}</div>
@elseif(Session::has('error'))
<div class="alert alert-danger suc_msg">{{Session::get('error')}}</div>
@else
@endif
@if(!empty($tasks)&&count($tasks)>0)
@foreach($tasks as $value)
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right">28<br>Dec</div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                <h3>{{$value->title}}</h3>
                                                    <p>{{$value->description}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer" style="padding: 0;text-align: right;">
                                            <div class="icon-links quick-icon-links">
            <a href="{{route('admin.task.edit',$value)}}"  data-toggle="tooltip" type="button" class="btn btn icon-btn" title="button"><i class="fa fa-pencil"></i></a>

                                            </div>
                                            <div class="icon-links quick-icon-links">
                                              
                                                    <form action="{{route('admin.task.destroy',$value)}}"  method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" data-toggle="tooltip" type="button" id="" title="Unpublish" class="btn btn icon-btn">
                                                                    <i class="fa fa-power-off"></i>
                                                                </button>
                                                     </form>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                         @endif     
{{$tasks->links()}}





     
@endsection
@section('js')

@endsection
