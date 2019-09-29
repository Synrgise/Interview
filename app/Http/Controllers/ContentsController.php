<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Task;

class ContentsController extends Controller
{
    public function index(){
        $data=[];
        $data['tasks']= Task::orderBy('id','desc')->where('is_compleated',0)->paginate(10);
        $data['taskscomp']= Task::orderBy('id','desc')->where('is_compleated',1)->paginate(10);
      return view('index',$data);
    }

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

        return redirect()->route('index');
    }

}
