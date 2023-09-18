<?php

namespace App\Models;

use App\Models\User;
use App\Models\Wallets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WalletTransactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'wallet_id',
        'ref_id',
        'amount',
        'is_credit',
        'reason'

    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function walet(){
        return $this->belongsTo(Wallets::class,'wallet_id','id');
    }
}
