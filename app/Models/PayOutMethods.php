<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayOutMethods extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'payment_method',
        'payment_type',
        'value',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id'  );
    }

}
