<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Media;


class categories extends Model
{
    use HasFactory;
    protected $fillable = [

        'name_ar',
        'name_en',
        'media_id',
        'user_id',
    ];


    public function user(){
        return $this->belongsTo(User::class , 'user_id','id' );
    }

    public function media(){
        return $this->belongsTo(Media::class,'media_id','id');
     }
}
