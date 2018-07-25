<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\Http\Resources\Todo as TodoResource;

class ManagerHomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:manager');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manager');
    }

    public function getAll()
    {
        // $todo = Todo::where('id', 1).get();
        $todo = Todo::orderBy('created_at', 'desc')->paginate(5);
        return TodoResource::collection($todo);
    }
}
