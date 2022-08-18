<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Point;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use Illuminate\Support\Facades\Validator;

class PointController extends Controller
{
        protected $point;
    
     public function __construct(Point $point)
    {
        $this->point = $point;
    }

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
        $results= Point::orderBy('typeuses')->paginate(10);

        return view('admin.point.index', compact('page', 'main_menu', 'sub_menu','results'));
  
    }
    
   
  
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = trans('pages_names.add_car_make');

        $main_menu = 'point';
        $sub_menu = 'Points are redeemed for balance';

        return view('admin.point.create', compact('page', 'main_menu', 'sub_menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
        Validator::make($request->all(), [
            'no_point' => 'required',
            'price' => 'required',

        ])->validate();

       
        Point::create($request->all());

        $message = trans('succes_messages.car_make_added_succesfully');

       return redirect()->back()->with('success', $message);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
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

        $main_menu = 'point';
        $sub_menu = 'Points are redeemed for balance';
    $point=Point::find($id);
        return view('admin.point.update', compact('page', 'main_menu', 'sub_menu','point'));
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
            'no_point' => 'required',
            'price' => 'required',
        ])->validate();

        $updated_params = $request->all();
        
          $point=Point::find($id);
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
         Point::find($id)->delete();

        $message = trans('succes_messages.car_make_deleted_succesfully');
          return redirect()->back()->with('success', $message);
    }
    
}
