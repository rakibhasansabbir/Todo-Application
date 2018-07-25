<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manager;
use App\Http\Resources\Manager as ManagerResource;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get manager
        $manager = Manager::orderBy('created_at', 'desc')->paginate(5);

        // Return collection of manager as a resource
        return ManagerResource::collection($manager);
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
        $manager = $request->isMethod('put') ? Manager::findOrFail($request->manager_id) : new Manager;

        $manager->name = $request->input('name');
        $manager->email = $request->input('email');
        $manager->password = bcrypt($request->input('password'));
        $manager->position = $request->input('position');

        if($manager->save()) {
            return new ManagerResource($manager);
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
        // Get manager
       $manager = Manager::findOrFail($id);

       // Return single manager as a resource
       return new ManagerResource($manager);
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
         // Get manager
         $manager = Manager::findOrFail($id);

         if($manager->delete()) {
             return new ManagerResource($manager);
         }    
    }
}
