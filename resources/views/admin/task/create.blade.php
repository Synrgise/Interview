@extends('admin.layouts.main')
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@endsection
@section('create')
{{-- <a href="{{route('admin.task.index')}}" class="col-md-2 offset-md-11 btn btn-info">List All</a> --}}

<div class="row new-task_panel" style="display: none;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><i class="fa fa-plus"></i> New Task</h4>
        </div>
        <div class="panel-body">
@if(Session::has('success'))
<div class="alert alert-success suc_msg">{{Session::get('success')}}</div>
@elseif(Session::has('error'))
<div class="alert alert-danger suc_msg">{{Session::get('error')}}</div>
@else
@endif

@if(!empty($task))
<form action="{{route('admin.task.update',$task)}}" enctype="multipart/form-data" method="post">
   @method('put')
    @else
    <form action="{{route('admin.task.store')}}"  enctype="multipart/form-data" method="post">

    @endif
    @csrf

    <div class="form-group ">
<label class="form-group">Task Name</label>
<input type="text" name="name" class="form-control" value="{{isset($task)&&!empty($task->name)?$task->name:old('name')}}">
@if($errors->has('name'))
<span class="text-danger">{{$errors->first('name')}} </span>
@endif
</div>

<div class="form-group">
<label class="form-group">Description</label>
 <input type="text" name="description" class="form-control" value="{{isset($task)&&!empty($task->description)?$task->description:old('description')}}">
 @if($errors->has('description'))
 <span class="text-danger">{{$errors->first('description')}} </span>
 @endif
</div>


<div class="col-md-6">
    <div class="row">
        <label class="col-md-4">Due Date</label>
        <div class="input-group col-md-8">
         <input type="text" name="date" id="date" class="form-control" value="{{isset($task)&&!empty($task->date)?$task->date:old('date')}}">
        @if($errors->has('date'))
         <span class="text-danger">{{$errors->first('date')}} </span>
        @endif
    </div>
</div>
</div>

<button type="submit" class="create-btn btn btn-primary waves-effect waves-light" >Create</button>
</form>
</div>
</div>
@endsection
@section('js')


<script>
    $(function(){
        $('#date').datepicker()
    })
    </script>

@endsection
