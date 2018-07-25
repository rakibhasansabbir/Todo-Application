<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Todo;
use App\Http\Resources\Todo as TodoResource;

class TodoController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:manager');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $todo = Todo::where('id', 1).get();
        
        $todo = Todo::where('manager_id', 1)->paginate(5);
        return TodoResource::collection($todo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = $request->isMethod('put') ? Todo::findOrFail($request->manager_id) : new Todo;

        $todo->title = $request->input('title');
        $todo->body = $request->input('body');
        $todo->manager_id = $request->input('manager_id');

        if($todo->save()) {
            return new TodoResource($todo);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get todo
       $todo = Todo::findOrFail($id);

       // Return single todo as a resource
       return new TodoResource($todo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // Get todo
         $todo = Todo::findOrFail($id);

         if($todo->delete()) {
             return new TodoResource($todo);
         }    
    }
}
