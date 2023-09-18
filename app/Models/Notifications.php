<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Notifications extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'massage',
        'title',
    ];

    public function user(){
        return $this->hasOne(User::class , 'user_id','id' );
    }

    public static function sendNotification($input )
    {
        $firebaseToken = User::whereNotNull('fbtoken')->pluck('fbtoken')->all();

        $SERVER_API_KEY = 'AAAA1ITDtAc:APA91bFydfuOzd1bfuk9xILYTYKA3rdlpoUajJM-8nMnrcuE6M6Nk1JKEN35l9PyolWTK0Js0zcP3HoT2Njkme9BVFyiGBcE1J4_QYlnHLpWGBjztRVfYpsPMPr-IeTGTOeJhgXMr8V_';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $input["title"],
                "body" => $input['massage'],
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
        Log::debug("$response");
       // dd($response);
    }



}