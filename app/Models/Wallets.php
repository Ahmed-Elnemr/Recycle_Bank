<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallets extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'balance',

    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    ###############################################
    public static function search($term) {


        $select = array(
            "wallets.id as id",
            "username.name as name",
            "wallets.balance as balance",
        );

        $wallets =  DB::table('wallets')
        ->select(  $select )
        ->leftJoin('users as username', 'username.id', '=', 'wallets.user_id')
        ->where('username.name', 'like', '%' . $term. '%')
        ->orderBy('wallets.id', 'desc')->paginate(10);

            return $wallets;
    }
}
