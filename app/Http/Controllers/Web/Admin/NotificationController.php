<?php

namespace App\Http\Controllers\Web\Admin;

use App\Base\Constants\Auth\Role;
use App\Base\Constants\Masters\PushEnums;
use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\BaseController;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Jobs\UserDriverNotificationSaveJob;
use App\Models\Admin\Driver;
use App\Models\Admin\Notificationapp;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\SendAdminstratorNotification;


class NotificationController extends BaseController
{
    protected $notification;

    protected $imageUploader;
    /**
     * NotificationController constructor.
     *
     * @param \App\Models\Admin\Notification $notification
     */
    public function __construct(Notificationapp $notification, ImageUploaderContract $imageUploader)
    {
        $this->notification = $notification;
        $this->imageUploader = $imageUploader;
    }

    public function index()
    {
        $page = trans('pages_names.push_notification');

        $main_menu = 'notifications';
        $sub_menu = 'push_notification';

        return view('admin.notification.push.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function fetch(QueryFilterContract $queryFilter)
    {
        $query = $this->notification->query();
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

        return view('admin.notification.push._pushnotification', compact('results'));
    }

    public function pushView()
    {
        $page = trans('pages_names.push_notification');

        $main_menu = 'notifications';
        $sub_menu = 'push_notification';

        $users = User::companyKey()->belongsToRole(Role::USER)->active()->get();
        $drivers = Driver::get();

        if (env('APP_FOR')=='demo') {
            $drivers = Driver::whereHas('user', function ($query) {
                $query->where('company_key', auth()->user()->company_key);
            })->get();
        }

        return view('admin.notification.push.sendpush', compact('page', 'main_menu', 'sub_menu', 'users', 'drivers'));
    }

    public function sendPush(Request $request)
    {
        
        
        
        $notification= new Notificationapp();
        
       $notification->title_ar = $request->title_ar;
        $notification->title_en = $request->title_en;
        $notification->push_enum =PushEnums::GENERAL_NOTIFICATION;
        $notification->body_ar = $request->message_ar;
        $notification->body_en = $request->message_en;


        if ($uploadedFile = $this->getValidatedUpload('image', $request)) {
              
            $notification->image = $this->imageUploader->file($uploadedFile)
                ->savePushImage();
        }
        
        
   

        $notification->save();

        if ($request->has('user')) {
            $notification->update(['for_user' => true]);

            User::whereIn('id', $request->user)->chunk(20, function ($userData) use ($notification,$request) {
                
              

                
              
                $push_data = ['title_ar' => $notification->title_ar,
                'title_en' => $notification->title_en,
                'message_ar' => $notification->body_ar,
                 'message_en' => $notification->body_en,
                'image' => $notification->push_image];
                $image = $notification->push_image;

                foreach ($userData as $key => $value) {
                    
       if($value->lang=='en'){
       $title = $notification->title_en;
       $body =$notification->body_en;

       }
    else{
        
        
         $title = $notification->title_ar;
         $body=$notification->body_ar; 
       }
                    
                    $value->notify(new AndroidPushNotification($title, $body, $push_data, $image));
                    
                    
                    
                    
                    $title_ar = $notification->title_ar;
                    $title_en = $notification->title_en;
                    $body_en =$notification->body_en;
                    $body_ar =$notification->body_ar; 
                        
     
      
        $value->notify(new SendAdminstratorNotification($title_ar,$title_en,$body_ar, $body_en));





                    
                    
                    
                }
                
                
            });
        }

        if ($request->has('driver')) {
            $notification->update(['for_driver' => true]);

            Driver::whereIn('id', $request->driver)->chunk(20, function ($driverData) use ($notification,$request) {
                
                
              
                $push_data = ['title_ar' => $notification->title_ar,
                'title_en' => $notification->title_en,
                
                'message_ar' => $notification->body_ar,
                
                'message_en' => $notification->body_en,
                'image' => $notification->push_image];
                $image = $notification->push_image;

                foreach ($driverData as $key => $value) {
                    
                    
      if( $value->user->lang=='en'){
       $title = $notification->title_en;
       $body =$notification->body_en;

       }
    else{
        
        
         $title = $notification->title_ar;
         $body=$notification->body_ar; 
       }
           
           
                    $value->user->notify(new AndroidPushNotification($title, $body, $push_data, $image));
                    
                           
                    $title_ar = $notification->title_ar;
                    $title_en = $notification->title_en;
                    $body_en =$notification->body_en;
                    $body_ar =$notification->body_ar; 
                        
     
      
       $value->user->notify(new SendAdminstratorNotification($title_ar,$title_en,$body_ar, $body_en));
                }
            });
        }

        dispatch(new UserDriverNotificationSaveJob($request->user, $request->driver, $notification));

        $message = trans('succes_messages.push_notification_send_successfully');

        return redirect('notifications/push')->with('success', $message);
    }

    public function delete(Notificationapp $notification)
    {
        $notification->delete();

        $message = trans('succes_messages.push_notification_deleted_successfully');

        return redirect('notifications/push')->with('success', $message);
    }
}
