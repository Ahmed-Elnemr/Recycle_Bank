<?php

namespace App\Models;

use App\Models\Notifications;
use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AssociationModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'value',
        'approved_on',
        'state',
        'user_order',
        'claimed',
        'claimed_date',
        'finished',
        'finished_date',
        'suspended',
        'due_date',
        'last_installment_date',
        'next_month',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function adjustWallet($AssociationID, $wallet_id, $isCredit, $amount): bool
    {
        $r = false;
        $WalletTransactions = new WalletTransactions();
        $AssociationModel = self::Where('id', $AssociationID)->first();
        $Wallets = Wallets::Where('id', $wallet_id)->first();
        if (self::doIneedToAct($AssociationModel) === true) {

            if ($isCredit === false) {

                if ($Wallets->balance >= $amount) {
                    $Wallets->balance = ($Wallets->balance - $amount);
                    $Wallets->save();

                    $WalletTransactions->user_id = $Wallets->user_id;
                    $WalletTransactions->wallet_id = $Wallets->id;
                    $WalletTransactions->amount = $amount;
                    $WalletTransactions->is_credit = true;
                    $WalletTransactions->reason = "installment";
                    $WalletTransactions->save();

                    $AssociationModel->last_installment_date = new DateTime();
                    $AssociationModel->next_month = date('m', strtotime('first day of +1 month'));
                    $AssociationModel->save();

                    $AssociationTransavtions = new AssociationTransavtions();
                    $AssociationTransavtions->association_models_id = $AssociationModel->id;
                    $AssociationTransavtions->user_id = $Wallets->user_id;
                    $AssociationTransavtions->value = $amount;
                    $AssociationTransavtions->currunt_month = date('m');
                    $AssociationTransavtions->next_month = date('m', strtotime('first day of +1 month'));
                    $AssociationTransavtions->wallet_id = $Wallets->id;
                    $AssociationTransavtions->wallet_transactions_id = $WalletTransactions->id;

                    $AssociationTransavtions->save();
                    $r = true;

                } else {
                    $input["user_id"] = $AssociationModel->user_id;
                    $input["title"] = "خطي في التسويه";
                    $input["massage"] = "قم بايداع قيمه الجمعيه في المحفظه ";
                    $input["massage"] .= " خطي في التسويه";
                    $input["massage"] .= "  الرصيد لا يكفي لسداد اقساط الجمعيه برجاء المراجعه";
                    self::sendNotification($input);
                }
            } else {

                $Wallets->balance = ($Wallets->balance + $amount);
                $Wallets->save();

                $WalletTransactions->user_id = $Wallets->user_id;
                $WalletTransactions->wallet_id = $Wallets->id;
                $WalletTransactions->amount = $amount;
                $WalletTransactions->is_credit = false;
                $WalletTransactions->reason = "claimed";

                $WalletTransactions->save();

                $AssociationModel->claimed_date = new DateTime();
                $AssociationModel->claimed = true;
                $AssociationModel->last_installment_date = new DateTime();
                $AssociationModel->next_month = date('m', strtotime('first day of +1 month'));
                $AssociationModel->save();

                $AssociationTransavtions = new AssociationTransavtions();
                $AssociationTransavtions->association_models_id;
                $AssociationTransavtions->user_id = $Wallets->user_id;
                $AssociationTransavtions->value = $amount;
                $AssociationTransavtions->currunt_month = date('m');
                $AssociationTransavtions->next_month = date('m', strtotime('first day of +1 month'));
                $AssociationTransavtions->wallet_id = $Wallets->id;
                $AssociationTransavtions->wallet_transactions_id = $WalletTransactions->id;

                $AssociationTransavtions->save();
                $r = true;

            }

        } else {

        }

        return $r;
    }

    public static function doIneedToAct(AssociationModel $asoc): bool
    {

        $r = false;

        $tranaction = AssociationTransavtions::Where('association_models_id', $asoc->id)->Where('currunt_month', date('m'))->orderBy('id', 'DESC')->first();

        if ($tranaction == null) {
            $r = true;
        }

        return $r;

    }
    public static function makepayment($id)
    {
        $AssociationModel = self::Where('id', $id)->with('user')->first();

        $Wallets = Wallets::Where('user_id', $AssociationModel->user_id)->first();

        $AssociationTransavtions = AssociationTransavtions::Where('association_models_id', $id)->get();

        //$AssociationModel->user_order;

        $user_payments = 0;
        if ($AssociationTransavtions == null || sizeof($AssociationTransavtions) == 0) {

        } else {
            $user_payments = sizeof($AssociationTransavtions);
        }

        $adjasted = false;
        $isMyTurn = false;

        switch ($AssociationModel->user_order) {
            case 1:
                $isMyTurn = true;
                break;

            case 2:
                if ($user_payments == 1) {
                    $isMyTurn = true;
                }

                break;

            case 3:
                if ($user_payments == 2) {
                    $isMyTurn = true;
                }
                break;

            case 4:
                if ($user_payments == 3) {
                    $isMyTurn = true;
                }
                break;

            case 5:
                if ($user_payments == 4) {
                    $isMyTurn = true;
                }
                break;

            case 6:
                if ($user_payments == 5) {
                    $isMyTurn = true;
                }
                break;

            case 7:
                if ($user_payments == 6) {
                    $isMyTurn = true;
                }
                break;

            case 8:
                if ($user_payments == 7) {
                    $isMyTurn = true;
                }
                break;

            case 9:
                if ($user_payments == 8) {
                    $isMyTurn = true;
                }
                break;

            case 10:
                if ($user_payments == 9) {
                    $isMyTurn = true;
                }
                break;

        }

        $v = $AssociationModel->value;
        if ($isMyTurn == true) {
            $v = $AssociationModel->value * 10;
        }
        $adjasted = self::adjustWallet($id, $Wallets->id, $isMyTurn, $v);
        if ($adjasted == true) {

            $t10 = $AssociationModel->value * 10;
            if ($isMyTurn == true) {
                $input["user_id"] = $AssociationModel->user_id;
                $input["title"] = "ايداع في المحفظه";
                $input["massage"] = "تم ايداع قيمه الجمعيه في المحفظه ";
                $input["massage"] .= " $t10 ح.م";
                $input["massage"] .= " برجاء المراجعه";
                self::sendNotification($input);
            } else {
                $input["user_id"] = $AssociationModel->user_id;
                $input["title"] = "سحب من المحفظه";
                $input["massage"] = "تم سحب قيمه الجمعيه من المحفظه ";
                $input["massage"] .= " $AssociationModel->value  ح.م";
                $input["massage"] .= " برجاء المراجعه";
                self::sendNotification($input);

            }

        }

    }
    public static function approve($id)
    {
        $AssociationModel = self::Where('id', $id)->first();
        $AssociationModel->approved_on = new DateTime();
        $AssociationModel->state = "approved";
        //+10 month

        $fd = new DateTime();
        $fd->modify('+10 month');
        $dudate = new DateTime();
        $dudate->modify("+" . $AssociationModel->user_order . " month");
        $AssociationModel->finished_date = $fd;
        $AssociationModel->due_date = $dudate;
        $AssociationModel->save();

        $input["user_id"] = $AssociationModel->user_id;
        $input["title"] = "مبروك ، لقد تم الموافقه الجميعه";
        $input["massage"] = "تم الموافقه علي انضمام الي الجمعيه بقيمه ";
        $input["massage"] .= " $AssociationModel->value  ح.م";
        $input["massage"] .= " برجاء الالتزام بمواعيد السداد";

        self::sendNotification($input);

    }
//fire base
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
        $Notifications = new Notifications();
        $Notifications->user_id = $input["user_id"];
        $Notifications->title = $input["title"];
        $Notifications->massage = $input['massage'];
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

    ############################
    public static function search($term)
    {

        $select = array(
            "username.name as name",
            "association_models.id as id",
            "association_models.value as value",
            "association_models.approved_on as approved_on",
            "association_models.state as state",
            "association_models.user_order as user_order",
            "association_models.finished_date as finished_date",
            "association_models.due_date as due_date",
            "association_models.suspended as suspended",
            "association_models.last_installment_date as last_installment_date",
            "association_models.user_id as user_id",
        );

        $associations = DB::table('association_models')
            ->select($select)
            ->leftJoin('users as username', 'username.id', '=', 'association_models.user_id')
            ->where('username.name', 'like', '%' . $term . '%')
            ->orderBy('association_models.id', 'desc')->paginate(10);

        return $associations;
    }
}