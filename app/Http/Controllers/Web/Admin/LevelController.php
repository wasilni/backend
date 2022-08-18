<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         $page = trans('pages_names.view_car_make');

        $main_menu = 'master';
        $sub_menu = 'car_make';
        $results= Level::orderBy('no_point')->paginate(4);

        return view('admin.levels.index', compact('page', 'main_menu', 'sub_menu','results'));
  
  
  
  
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $page = trans('pages_names.add_car_make');

        $main_menu = 'level';
        $sub_menu = 'level';
    $point=Level::find($id);
        return view('admin.levels.update', compact('page', 'main_menu', 'sub_menu','point'));
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
         Validator::make($request->all(), [
             'name_ar' => 'required',
            'name_en' => 'required',
            'no_point' => 'required',
            'no_trip' => 'required',
        ])->validate();

        $updated_params = $request->all();
        
          $point=Level::find($id);
        $point->update($updated_params);
        $message = trans('succes_messages.car_make_updated_succesfully');
         return redirect()->back()->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
