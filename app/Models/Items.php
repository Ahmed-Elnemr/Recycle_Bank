<?php

namespace App\Models;

use App\Models\categories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Items extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'piece',
        'weight',
        'value',
        'user_id',
        'media_id',
        'category_id',
    ];


    public function user(){
        return $this->belongsTo(User::class , 'user_id','id' );
    }
    public function category()
    {
        return $this->belongsTo(categories::class, 'category_id','id' );
    }
    public function media(){
        return $this->belongsTo(Media::class,'media_id','id');
     }



}