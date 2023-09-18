<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $table = 'address';
    use HasFactory;
    protected $fillable = [
        'city',
        'country',
        'street',
        'postal_code',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }

}