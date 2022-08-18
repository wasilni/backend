<?php

namespace App\Http\Controllers\Api\V1\Auth\Registration;

use App\Models\User;
use Illuminate\Http\Request;
use App\Base\Constants\Auth\Role;
use App\Transformers\User\UserTransformer;
use App\Base\Constants\Masters\WalletRemarks;
use App\Transformers\User\ReferralTransformer;
use App\Http\Controllers\Api\V1\BaseController;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Notifications\RferrelCodeNotification;
use App\Notifications\ReferrelcodeNotification;



/**
 * @group SignUp-And-Otp-Validation
 *
 * APIs for User-Management
 */
class ReferralController extends BaseController
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
    * Get Referral code
    * @responseFile responses/auth/get-referral.json
    */
    public function index()
    {
        $user = fractal(auth()->user(), new ReferralTransformer);

        return $this->respondOk($user);
    }
    /**
    * Update User Referral
    * @bodyParam refferal_code string required refferal_code of the another user
    * @response {"success":true,"message":"success"}
    */
    public function updateUserReferral(Request $request)
    {
        // Validate Referral code
        
        
        $reffered_user = $this->user->belongsTorole(Role::USER)->where('refferal_code', $request->refferal_code)->whereNotIn('id',[\Auth::User()->id])->first();
    

        if (!$reffered_user) {
            $this->throwCustomException('Provided Referral code is not valid', 'refferal_code');
        }

        // Update referred user's id to the users table
        auth()->user()->update(['referred_by'=>$reffered_user->id]);

        $user_wallet = $reffered_user->userWallet;
        $referral_commision = get_settings('referral_commision_for_user')?:0;

        $user_wallet->amount_added += $referral_commision;
        $user_wallet->amount_balance += $referral_commision;
        $user_wallet->save();

        // Add the history
        $reffered_user->userWalletHistory()->create([
            'amount'=>$referral_commision,
            'transaction_id'=>str_random(6),
            'remarks'=>WalletRemarks::REFERRAL_COMMISION,
            'refferal_code'=>$reffered_user->refferal_code,
            'is_credit'=>true]);

        // Notify user
        
        
        
       if($reffered_user->lang=='en'){
       $title ='You have Earned with your Referral code 😊️' ;
       $body = 'You have Earned with your Referral code 😊️';
        $message = 'You have Earned with your Referral code 😊️';
    
       }
    else{
        $title = 'تم تفعيل كود الاحالة لديك';
        $body = ' تم استلامك أموال كود الاحالة   ';
          $message = 'تم استلامك أموال كود  الاحالة   ';
       }
       
      $title_ar =  'تم تفعيل كود الاحالة لديك';
      $body_ar = 'تم استلامك أموال كود الاحالة';
      $title_en ='You have Earned with your Referral code 😊️' ;
      $body_en = 'You have Earned with your Referral code 😊️';
      
      
        $reffered_user->notify(new RferrelCodeNotification($title_ar,$title_en,$body_ar, $body_en));

        $reffered_user->notify(new AndroidPushNotification($title, $body));

        // $title = trans('push_notifications.referral_earnings_notify_title');
        // $body = trans('push_notifications.referral_earnings_notify_body');


        return $this->respondSuccess();
    }

    /**
    * Update Driver Referral code
    * @bodyParam refferal_code string required refferal_code of the another user
    * @response {"success":true,"message":"success"}
    */
    public function updateDriverReferral(Request $request)
    {
        $reffered_user = $this->user->belongsTorole(Role::DRIVER)->where('refferal_code', $request->refferal_code)->first();

        if (!$reffered_user) {
            $this->throwCustomException('Provided Referral code is not valid', 'refferal_code');
        }

        // Update referred user's id to the users table
        auth()->user()->update(['referred_by'=>$reffered_user->id]);

        // Add referral commission to the referred user
        $reffered_user = $reffered_user->driver;

        $driver_wallet = $reffered_user->driverWallet;
        $referral_commision = get_settings('referral_commision_for_driver')?:0;

        $driver_wallet->amount_added += $referral_commision;
        $driver_wallet->amount_balance += $referral_commision;
        $driver_wallet->save();

        // Add the history
        $reffered_user->driverWalletHistory()->create([
            'amount'=>$referral_commision,
            'transaction_id'=>str_random(6),
            'remarks'=>WalletRemarks::REFERRAL_COMMISION,
            'refferal_code'=>$reffered_user->refferal_code,
            'is_credit'=>true]);

        // Notify user
        // $title = trans('push_notifications.referral_earnings_notify_title');
        // $body = trans('push_notifications.referral_earnings_notify_body');

        // $reffered_user->user->notify(new AndroidPushNotification($title, $body));
        
        
        
        
              
        
                     
if($reffered_user->user->lang=='en'){
       $title ='You have Earned with your Referral code 😊️';
        $body = 'We are happy to inform you that you have earned money with your referral code';
    
}
else{
       $title ='انت كسبت مع كود الاحالة ';
        $body = 'نحن سعيدين لخنبرك انك الان تمتلك اموال بسبب تفعيل كود الاحالة';
}

      $reffered_user->user->notify(new AndroidPushNotification($title, $body));
        
        
        
        
       $title_en ='You have Earned with your Referral code 😊️';
       $body_en = 'We are happy to inform you that you have earned money with your referral code';
       
      $title_ar ='انت كسبت مع كود الاحالة ';
      $body_ar = 'نحن سعيدين لخنبرك انك الان تمتلك اموال بسبب تفعيل كود الاحالة';

       
    
        
 $notifable_driver->notify(new ReferrelcodeNotification($title_ar,$title_en, $body_ar,$body_en));
 
 
 
 
 

        return $this->respondSuccess();
    }
}
