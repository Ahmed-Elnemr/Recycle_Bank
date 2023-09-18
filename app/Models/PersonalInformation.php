<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonalInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'personal_id',
        'idendety_type',
        'gender',
        'birthdate',
        'phone_number',
        'nationality',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id'); 
    }
    
}