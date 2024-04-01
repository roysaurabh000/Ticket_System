<?php

namespace App\Http\Controllers;
use App\Models\Todo;

use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function index(){
        $todos=Todo::all();
        return view("todos.index",compact('todos'));
    }


    public function create(){
        return view("todos.create");
    }
    public function store(Request $request){
        $this -> validate($request,[
            'title'=>'required|min:4|max:50',
            'description'=>'required|min:4'
        ]);
        $todo=Todo::create([
            'name'=>$request->title,
            'description'=>$request->description
        ]);

        if($todo){
            return redirect()->route('todos.index')->with('success','ticket created successfully!');
        }
        return redirect()->route('todos.index')->with('error','unable to  create ticket ');
    }
    public function show($id){
        $todo=Todo::find($id);
        return view("todos.show",compact('todo'));
       
    }
    public function edit($id){
        $todo=Todo::find($id);
        return view("todos.edit",compact('todo'));
       
    }
    public function update(Request $request, $id){
        $todo=Todo::find($id);
        if($todo)
        {
            $this -> validate($request,[
                'title'=>'required|min:4|max:50',
                'description'=>'required|min:4',
                'completed'=>'required'
            ]);
            $todo->name=$request->title;
            $todo->description=$request->description;
            $todo->is_completed=$request->completed;
            $todo->save();
            return redirect()->route('todos.index')->with('success','ticket updated successfully!');

        }
        return redirect()->route('todos.index')->with('error','unable to  update ticket');
       
    } 
    public function destroy($id){
        $todo=Todo::find($id);
        if($todo)
        {
            $todo->delete();
            return redirect()->route('todos.index')->with('success','ticket Deleted successfully!');
        }
        return redirect()->route('todos.index')->with('error','unable to  Delete ticket');
    }
}
