<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\PersonalInformation;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'fbtoken'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */

    protected $appends = [
        'profile_photo_url',
    ];

    public function orders(){
        return $this->hasMany(Orders::class , 'user_id','id' );
    }

    public function address(){
        return $this->hasMany(Address::class , 'user_id','id' );
    }

    public function rols(){
        return $this->hasOne(Rols::class , 'id','role_id' );
    }


    public static function getArray(){
        return  DB::table("users")
     //   ->addSelect(DB::raw("* , COUNT(*) as total)"))
     //   ->addSelect(DB::raw("MONTH('created_at') as month"))
    //    ->groupBy(DB::raw("MONTH('created_at')"))
    //    ->whereYear('created_at', date('Y'))
    //    ->get() ;
        ->select(DB::raw('count(id) as `total`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),  DB::raw('YEAR(created_at) year, MONTH(created_at) month'))

        ->groupby('new_date','year','month')
        ->get();


    }

    public static function getMatrix():array{

        $r["m"] = "";
        $r["d"] = "";
        $data = self::getArray();

        if($data != null){
                foreach(  $data as $key => $value)
                {
                    $r["m"] .="  $value->month , ";
                    $r["d"] .="  $value->total , ";
                }
        }

        return $r;

    }



}
