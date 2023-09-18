<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationTransavtions extends Model
{
    use HasFactory;

    protected $fillable = [
        'association_models_id',
        'user_id',
        'value',
        'currunt_month',
        'next_month',
        'wallet_id',
        'wallet_transactions_id'
    ];
    
}
