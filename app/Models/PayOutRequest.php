<?php

namespace App\Models;

use App\Models\User;
use App\Models\PayOutMethods;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayOutRequest extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'amount',
        'reason',
        'pay_out_methods_id',
    ];


    public static function sendNotification($input)
    {
        $firebaseToken = User::whereNotNull('fbtoken')->where('id' , $input["user_id"])->pluck('fbtoken')->all();

        $SERVER_API_KEY = 'AAAA1ITDtAc:APA91bFydfuOzd1bfuk9xILYTYKA3rdlpoUajJM-8nMnrcuE6M6Nk1JKEN35l9PyolWTK0Js0zcP3HoT2Njkme9BVFyiGBcE1J4_QYlnHLpWGBjztRVfYpsPMPr-IeTGTOeJhgXMr8V_';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $input["title"],
                "body" => $input['massage'],
            ]
        ];
        $Notifications = new Notifications();
        $Notifications->user_id =   $input["user_id"];
        $Notifications->title =     $input["title"];
        $Notifications->massage  =  $input['massage'];
        $Notifications->save();

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


    }


    public static function settleup($id) : bool
    {
        $r = false;

        $myr = self::Where('id' , $id)->first();


        if($myr != null)
        {

                $Wallet = Wallets::where('user_id' , $myr->user_id)->first();

                if($Wallet->balance >= $myr->amount)
                {

                    $WalletTransactions =  new WalletTransactions();
                    $WalletTransactions->user_id = $Wallet->user_id;
                    $WalletTransactions->wallet_id =$Wallet->id;
                    $WalletTransactions->amount = $myr->amount;
                    $WalletTransactions->is_credit = true;
                    $WalletTransactions->reason = "withdraw";
                    $WalletTransactions->save();
                    $Wallet->balance = ($Wallet->balance -  $myr->amount );
                    $Wallet->save();

                    $input["user_id"] = $Wallet->user_id;
                    $input["title"] =  "عمليه سحب من الحساب" ;
                    $input["massage"] = "تم تنفيذ عمليه السحب التي قمت بطلبها  ";
                    $input["massage"] .=" بقيمه $myr->amount" ;
                    $input["massage"] .="برجاء فحص رصيدك " ;
                    self::sendNotification($input);
                    $myr->reason = "done" ;
                    $myr->save();

                    $r = true;

                }else
                {
                    $input["user_id"] = $Wallet->user_id;
                    $input["title"] =  "فشل في عمليه السحب من رصيدك" ;
                    $input["massage"] = "تعذر تنفيذ طلب السحب من رصيد  ";
                    $input["massage"] .=" بقيمه $myr->amount" ;
                    $input["massage"] .="برجاء التاكد من وجود رصيد كافي  " ;
                    $myr->reason = "error" ;
                    $myr->save();

                    self::sendNotification($input);
                }


        }






        return $r;
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }


    public function payOutMethods(){
        return $this->belongsTo(PayOutMethods::class,'pay_out_methods_id','id');
    }


    public static function search($term) {


        $select = array(
            "pay_out_requests.id as id",
            "username.name as name",
            "username.id as userid",
            "pay_out_requests.amount as amount",
            "pay_out_requests.reason as reason",
            "pay_out_methods_value.value as value",


        );

        $payOuts =  DB::table('pay_out_requests')
        ->select(  $select )
        ->leftJoin('users as username', 'username.id', '=', 'pay_out_requests.user_id')
        ->leftJoin('pay_out_methods as pay_out_methods_value', 'pay_out_methods_value.id', '=', 'pay_out_requests.pay_out_methods_id')
        ->where('username.name', 'like', '%' . $term. '%')
        ->orderBy('pay_out_requests.id', 'desc')->paginate(10);
            return $payOuts;
    }
}
