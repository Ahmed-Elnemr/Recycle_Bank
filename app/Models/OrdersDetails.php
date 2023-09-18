<?php

namespace App\Models;

use App\Models\User;
use App\Models\Items;
use App\Models\Orders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrdersDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'order_id',
        'item_id',
        'quantity',
        'total_price',
        'item_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function item()
    {
        return $this->belongsTo(Items::class, 'item_id', 'id');
    }

    public function items()
    {
        return $this->belongsTo(Items::class);
    }

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }
}