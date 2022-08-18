<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Point;
use App\Models\Payment\UserWallet;
use App\Models\User;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Base\Constants\Auth\Role;
use App\Notifications\TransferePointNotification;
use App\Base\Constants\Masters\WalletRemarks;
use Illuminate\Notifications\Notifiable;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $Point = Point::all();
         return $this->respondOk($Point);
         
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
    
      public function transferepoints(Request $request)
    {
        // $request->point_id;
        // $request->user_id;

        $point= Point::where('id',$request->point_id)->first();
        $user=User::find(\Auth::user()->id);

        $user->points_balance=$user->points_balance - $point->no_point;
        $user->update();
         $wallet=UserWallet::where('user_id',\Auth::user()->id)->first();
         $wallet->amount_balance=$wallet->amount_balance+$point->price;
         $wallet->update();
         $userrole=User::belongsTorole(Role::USER)->where('id',\Auth::user()->id)->first();
           $driverrole=User::belongsTorole(Role::DRIVER)->where('id',\Auth::user()->id)->first();
         if($userrole){
             
               $user_wallet_history = $userrole->userWalletHistory()->create([ 
                   'amount'=>$point->price,
                'transaction_id'=>str_random(6),
                'remarks'=>WalletRemarks::POINT_TRANSFERE,
                'is_credit'=>true]);

         }
         elseif($driverrole){
             
               $user_wallet_history = $driverrole->driverWalletHistory()->create([ 
                   'amount'=>$point->price,
                'transaction_id'=>str_random(6),
                'remarks'=>WalletRemarks::POINT_TRANSFERE,
                'is_credit'=>true]);

         }
                       
 $userid=\Auth::user()->id; 
        $user= User::find($userid);
            if($user->lang == 'ar'){
        $message ='    تم تحويل النقاط';
            }
            else{
              $message ='Done transfered Points  ';
           

            }
        // $message = trans('push_notifications.Done_transfered_points_body');

              return response()->json(['success'=>true,'message'=>$message]);
        
        
        
        
    }
    
    
      public function transferepointstofriend(Request $request)
    {
        
        
        // $request->moblie; to user 
        
        // $request->point_no;
        
                // $request->type;1=user 2=driver


        if($request->type==1){
        
         $friend= User::belongsTorole(Role::USER)->where('mobile',$request->mobile)->first();
        }
        else{
            $friend= User::belongsTorole(Role::DRIVER)->where('mobile',$request->mobile)->first();
        }

        if(isset($friend)){
      
         $friend->points_balance = $friend->points_balance + $request->point_no;
         $friend->update();
       
        $userid=\Auth::user()->id; 
        $user= User::find($userid);
        $user->points_balance= $user->points_balance - $request->point_no;
        $user->update();  
      
      if($user->lang=='en'){
       $title ='transfere point ' ;
        $body = 'transfere point Successfully';
         $message = 'transfere point Successfully';
    
       }
    else{
        $title = 'تحويل نقاط ';
        $body = 'تم تحويل نقاط اليك بنجاح   ';
          $message = 'تم تحويل نقاط اليك بنجاح   ';
       }
       
        
        
        
        
        $friend->notify(new AndroidPushNotification($title, $body));
      $title_ar = 'تحويل نقاط ';
        $body_ar = 'تم تحويل نقاط اليك بنجاح   ';
       $title_en ='transfere point ' ;
        $body_en = 'transfere point Successfully';
      
      
                  $friend->notify(new TransferePointNotification($title_ar,$title_en,$body_ar, $body_en));

        return response()->json(['success'=>true,'message'=>$message]);
        
          }  
        
        
        else{
            
              $userid=\Auth::user()->id; 
        $user= User::find($userid);
            if($user->lang == 'ar'){
        $message ='  الرقم غير موجود';
            }
            else{
              $message ='Number Not Found';
           

            }
            

              return response()->json(['success'=>false,'message'=>$message]); 
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
        
    }
  function allnotification(){
        
        
        // $notifications=\Auth::User()->notifications;
        
        $notifications=\Auth::User()->notifications()->paginate();
        return response()->json(['success'=>true,"message"=>'success','data'=>$notifications]);

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
