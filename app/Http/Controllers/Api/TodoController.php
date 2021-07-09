<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\RepeatedRespository;
use App\Models\Todo;
use App\Models\User;

class TodoController extends Controller
{
    protected  $repeatedRespository;


    public function __construct(RepeatedRespository $repeatedRespository){
        //
        $this->repeatedRespository = $repeatedRespository;
    }

    public function todoList(){
           $todos = User::find($this->repeatedRespository->guard()->user()->id);

            if(!is_null($todos)){
                return $this->repeatedRespository->responseTodo('Todo List', $todos->todos);
            }
            return $this->repeatedRespository->error('No Data Found');    
    }

    public function createTodo(Request $request){
     
        $validator = \Validator::make($request->all(),[ 
            'title'       => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->repeatedRespository->validation($validator->errors());
        }
            Todo::create([
                'title'         => $request->title,
                'description'  => $request->description,
                'user_id'      => $this->repeatedRespository->guard()->user()->id,
                'completed'   => false
            ]);

            return $this->repeatedRespository->response201('Todo Added');   
    }

    public function editTodo(Request $request){
        $validator = \Validator::make($request->all(),[ 
            'todo_id'    => 'required',
        ]);

        if ($validator->fails()) {
            return $this->repeatedRespository->validation($validator->errors());
        }
        $todo = Todo::find($request->todo_id);

        if(!is_null($todo)){
            return $this->repeatedRespository->responseTodo('Edit Todo', $todo);
        }
        return $this->repeatedRespository->error('No Data Found'); 

    }

    public function updateTodo(Request $request){
        $validator = \Validator::make($request->all(),[ 
            'todo_id'      => 'required',
            'name'         => 'required',
            'description'  => 'required',
            'user_id'      => 'required'
        ]);

        if ($validator->fails()) {
            return $this->repeatedRespository->validation($validator->errors());
        }

        if($request->user_id == $this->repeatedRespository->guard()->user()->id){
            Todo::where('id', $request->todo_id)->where('user_id' , $this->repeatedRespository->guard()->user()->id)
            ->update([
                'title'        => $request->name,
                'description' => $request->description
            ]);
    
            return $this->repeatedRespository->response('Todo Updated');
        }
        return $this->repeatedRespository->response403();
    }

    public function deleteTodo(Request $request){
        $validator = \Validator::make($request->all(),[ 
            'todo_id'      => 'required',
            'user_id'      => 'required'
        ]);

        if ($validator->fails()) {
            return $this->repeatedRespository->validation($validator->errors());
        }

        if($request->user_id == $this->repeatedRespository->guard()->user()->id){
            Todo::where('id', $request->todo_id)->where('user_id' , $this->repeatedRespository->guard()->user()->id)
            ->delete();

            return $this->repeatedRespository->response('Todo Deleted');  
        }
        return $this->repeatedRespository->response403();
    }
}
