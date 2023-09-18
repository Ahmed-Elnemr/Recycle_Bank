<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Notifications;
use App\Models\OrdersDetails;
use App\Models\User;
use App\Models\Wallets;
use App\Models\WalletTransactions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        '_id',
        'customer_id',
        'delivery_id',
        'note',
        'total',
        'address_id',
        'status',
        'user_id',

    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
    public function delivery()
    {
        return $this->belongsTo(User::class, 'delivery_id', 'id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(OrdersDetails::class, 'order_id', 'id');
    }

    public function peronalinfo()
    {
        return $this->HasOne(PersonalInformation::class, 'user_id', 'customer_id');
    }

    public static function getArray()
    {
        return DB::table("orders")
            ->select(DB::raw('count(id) as `total`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))

            ->groupby('new_date', 'year', 'month')
            ->get();

    }

    public static function getMatrix(): array
    {

        $r["m"] = "";
        $r["d"] = "";
        $data = self::getArray();

        if ($data != null) {
            foreach ($data as $key => $value) {
                $r["m"] .= "  $value->month , ";
                $r["d"] .= "  $value->total , ";
            }
        }

        return $r;

    }

    public static function updateWallet($id)
    {

        $orders = self::Where('id', $id)->with('customer')->with('delivery')->first();

        if ($orders->customer != null) {

            if ($orders->note == "cash") {
                $wallets = Wallets::where("user_id", $orders->customer->id)->first();
                $wallet_driver = Wallets::where("user_id", $orders->delivery->id)->first();

                if ($wallets != null) {
                    $wallets->balance = (($orders->total / 100) + $wallets->balance);
                    $wallets->save();
                } else {

                    $wallets = new Wallets();
                    $wallets->user_id = $orders->customer->id;
                    $wallets->balance = (($orders->total / 100));
                    $wallets->save();
                }

                if ($wallet_driver != null) {
                    $wallet_driver->balance = ($wallet_driver->balance - ($orders->total / 100));
                    $wallet_driver->save();
                } else {

                    $wallet_driver = new Wallets();
                    $wallet_driver->user_id = $orders->delivery->id;
                    $wallet_driver->balance = ($wallet_driver->balance - ($orders->total / 100));
                    $wallet_driver->save();
                }

                $WalletTransactions = new WalletTransactions();
                $WalletTransactions->user_id = $orders->customer->id;
                $WalletTransactions->wallet_id = $wallets->id;
                $WalletTransactions->ref_id = $orders->id;
                $WalletTransactions->amount = ($orders->total / 100);
                $WalletTransactions->is_credit = false;
                $WalletTransactions->reason = "ايداع";
                $WalletTransactions->save();

                $WalletTransactions2 = new WalletTransactions();
                $WalletTransactions2->user_id = $orders->delivery->id;
                $WalletTransactions2->wallet_id = $wallet_driver->id;
                $WalletTransactions2->ref_id = $orders->id;
                $WalletTransactions2->amount = ($orders->total / 100);
                $WalletTransactions2->is_credit = true;
                $WalletTransactions2->reason = "استلام بضاعه";
                $WalletTransactions2->save();

            }

        }

    }

    public static function updateOrderStatus($order_id, $status)
    {
        $orders = self::Where('id', $order_id)->with('customer')->with('delivery')->first();

        $orders->id = $order_id;
        $orders->status = $status;
        $orders->update();
        $text = $status;
        switch ($status) {

            case "approved":
                $text = "الموافقه";
                break;

            case "completed":

                $text = "مكتمل ";
                break;

            case "cancelled":
                $text = "ملغي ";
                break;

            case "cancelld":
                $text = "ملغي ";
                break;
            case "cancel":
                $text = "ملغي ";
                break;

            default:
                $text = $status;

                break;

        }
        if ($orders != null) {

            if ($orders->customer != null) {
                $input1["user_id"] = $orders->customer->id;
                $input1["title"] = "تم تغيير حاله طلبكم رقم " . $order_id;
                $input1["massage"] = "تم تغيير حاله الطلب رقم " . $order_id . " الي  " . " $text ";

                $note = new Notifications();
                $note->user_id = $orders->customer->id;
                $note->massage = $input1["massage"];
                $note->title = $input1["title"];
                $note->save();
                Orders::sendNotification($input1);
            }

            if ($orders->delivery != null) {
                $input["user_id"] = $orders->delivery->id;
                $input["title"] = "تم تغيير حاله الطلب رقم " . $order_id;
                $input["massage"] = "تم تغيير حاله الطلب رقم " . $order_id . " الي  " . " $text ";

                $note = new Notifications();
                $note->user_id = $orders->delivery->id;
                $note->massage = $input["massage"];
                $note->title = $input["title"];
                $note->save();
                Orders::sendNotification($input);
            }

        }

    }

    public static function ping($orderid)
    {
        $orders = Orders::find($orderid);

        $input1["user_id"] = $orders->customer->id;
        $input1["title"] = "تنبيه بخصوص الطلب  " . $orders->id;
        $input1["massage"] = " لقد قام مندوب الاستلام بالوصول الي عنوانك برجاء اعداد العناصر المراد بيعها ";

        $note = new Notifications();
        $note->user_id = $orders->customer->id;
        $note->massage = $input1["massage"];
        $note->title = $input1["title"];
        $note->save();
        Orders::sendNotification($input1);
    }
    public static function sendNotification($input)
    {
        $firebaseToken = User::whereNotNull('fbtoken')->where('id', $input["user_id"])->pluck('fbtoken')->all();

        $SERVER_API_KEY = 'AAAA1ITDtAc:APA91bFydfuOzd1bfuk9xILYTYKA3rdlpoUajJM-8nMnrcuE6M6Nk1JKEN35l9PyolWTK0Js0zcP3HoT2Njkme9BVFyiGBcE1J4_QYlnHLpWGBjztRVfYpsPMPr-IeTGTOeJhgXMr8V_';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $input["title"],
                "body" => $input['massage'],
            ],
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

    }
    ################################ order livewire
    public static function search($term)
    {

        $select = array(
            "orders.id as id",
            "orders.created_at as created_at",
            "customer.id as customerid",
            "delivery.name as deliveryname",
            "customer.name as customername",
            "orders.note as ordernote",
            "orders.total as ordertotal",
            "orders.status as status",
            "address.country as addresscountry",
            "address.city as addresscity",
            "address.street as addressstreet",
            "address.postal_code as addresspostal_code",

        );

        $orders = DB::table('orders')
            ->select($select)
            ->leftJoin('users as customer', 'customer.id', '=', 'orders.customer_id')
            ->leftJoin('users as delivery', 'delivery.id', '=', 'orders.delivery_id')
            ->leftJoin('address as address', 'address.id', '=', 'orders.address_id')
            ->where('customer.name', 'like', '%' . $term . '%')
            ->orderBy('orders.id', 'desc')->paginate(10);

        return $orders;
    }

}