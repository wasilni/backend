<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Request\Request;
use App\Models\Level;
/*
 * These routes use the root namespace 'App\Http\Controllers\Web'.
 */
Route::namespace('Web')->group(function () {

    // All the folder based web routes
    include_route_files('web');

    // Website home route
    Route::get('/', 'HomeController@index')->name('home');
});

Route::view('/adhoc1', 'adhoc/adhoc1')->name('adhoc1');
// Route::view('/adhoc2', 'adhoc/adhoc2')->name('adhoc2');
Route::view('/adhoc3', 'adhoc/adhoc3')->name('adhoc3');


Route::get('/adhoc', 'AdhocController@index');
Route::get('/adhoc2', 'AdhocController@create');



Route::get('/test-payment', function(){
    $telrManager = new \TelrGateway\TelrManager();

    $billingParams = [
            'first_name' => 'Moustafa Gouda',
            'sur_name' => 'Bafi',
            'address_1' => 'Gnaklis',
            'address_2' => 'Gnaklis 2',
            'city' => 'Alexandria',
            'region' => 'San Stefano',
            'zip' => '11231',
            'country' => 'EG',
            'email' => 'example@company.com',
        ];

    return $telrManager->pay('1', '10', 'DESCRIPTION ...', $billingParams)->redirect();

});
Route::get('/test', function(){
    $totalTrips = Request::where('driver_id',141)->companyKey()->whereIsCompleted(true)->count();
    return  $totalTrips;

//             $levfiesrt=Level::where('id','1')->first();
//             $levsecond=Level::where('id','2')->first();
//             $levthird=Level::where('id','3')->first();
//             $levsefourth=Level::where('id','4')->first();
//             $driver= User::where('id',auth()->user()->id)->first();

//   if($levfiesrt->no_trip >= $totalTrips){
//             $driver->level_ar =$levfiesrt->name_ar;
//             $driver->level_en =$levfiesrt->name_en;
//             $driver->update();

//             }
// elseif($levsecond->no_trip >= $totalTrips && $totalTrips < $levthird->no_trip){



//                 $driver->level_ar =$levsecond->name_ar;
//                 $driver->level_en =$levsecond->name_en;
//                 $driver->update();

//         }


//         elseif($levthird->no_trip >= $totalTrips && $totalTrips < $levsefourth->no_trip ){



//             $driver->level_ar =$levthird->name_ar;
//             $driver->level_en =$levthird->name_en;
//             $driver->update();

//     }

//     else{

//         $driver->level_ar =$levsefourth->name_ar;
//         $driver->level_en =$levsefourth->name_en;
//         $driver->update();
//     }



});
