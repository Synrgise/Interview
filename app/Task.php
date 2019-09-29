<?php

namespace App;
use Illuminate\Validation\Rule;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  public function rules($id=""){
   return [
       'title'=>['required',Rule::unique($this->table)->ignore($id)],
       'description'=>'required',
       'date'=>'required',
   ];
  }
  protected $fillable=['title','description','date'];
  protected $table="tasks";
}
