<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use App\Models\User;

use App\Http\Requests\StoreNotificationsRequest;
use App\Http\Requests\UpdateNotificationsRequest;
use Illuminate\Http\Request;
class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = User::find(\Auth::id());

       // $notifications = new Notifications();
       // $notifications->user_id = $authUser->id;
       // $notifications->massage = "welcome to our new app";
       // $notifications->title = "massage title";
       // $notifications->save();
        //fake method to add data to this Table :)

        if($authUser != null)
        {
             return Notifications::orWhere("user_id" , $authUser->id)->orWhereNull('user_id')->orderBy('id', 'DESC')->paginate(50);
        }else{

            return Notifications::WhereNull('user_id')->orderBy('id', 'DESC')->paginate(50);
        }


    }





    public function destroy($id)
    {
        $authUser = User::find(\Auth::id());
        $not =  Notifications::findOrFail($id);

        if($authUser->id  == $not->user_id)
        {
            return Notifications::destroy($id);
        }

    }
}
