<?php

namespace App\Http\Controllers\Admin;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Helper\Message;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TasksExport;





class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $data=[] ;
    $data['tasks'] = Task::orderBy('id','desc')->paginate(5);
    return view('admin.task.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.task.create');
    }
    public function show(){
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= [];
        $Task =new Task();
        $request->validate($Task->rules());
        $Task->title= $request->title;
        $Task->description= $request->description;
    
        $Task->date =$request->date;
        if($Task->save()){
        \Session::flash('success','Task added successfully');
        }else{
            \Session::flash('danger','Something went wrong please try agian later');

        }

        return redirect()->route('admin.task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $Task
     * @return \Illuminate\Http\Response
     */
    public function isCompleted(Task $task)
    {
       if($task->isCompleted==true){
        $task->isCompleted=false;
       }
      if($task->save()){
        \Session::flash('success','Task Compleation updated successfully');
    }else{
        \Session::flash('danger','Something went wrong please try agian later');

    }
       return redirect()->route('admin.task.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $Task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $Task)
    {
       $data= [];
       $data['task']= $Task;
       return view('admin.task.create',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $Task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $data= [];
        $request->validate($task->rules($task->id));
        $Task->title= $request->title;
        $Task->description= $request->description;
    
        $Task->date =$request->date;
      
        if($task->save()){
        \Session::flash('success','Task updated successfully');
        }else{
            \Session::flash('danger','Something went wrong please try agian later');

        }

        return redirect()->route('admin.task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $Task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $Task)
    {
        if($Task->delete()){
            \Session::flash('success','Task deleted successfully');
        }else{
            \Session::flash('error','Something went wrong please try again later');
        }
        return redirect()->back();
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function export()
    {
        return Excel::download(new TasksExport, 'tasks.xlsx');
    }

}
