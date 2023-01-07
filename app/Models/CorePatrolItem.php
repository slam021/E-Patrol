<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorePatrolItem extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table        = 'core_patrol_item';
    protected $primaryKey   = 'patrol_item_id';

    // protected $fillable = [
    //     'user_id',
    //     'full_name',
    //     'address',
    //     'phone_number',
    //     'phone_number_family',
    //     'email',
    // ];
    protected $guarded = [
        'patrol_item_id'
    ];

    public function corepatrolitem()
    {
        //setiap patrol memiliki banyak item
        return $this->hasMany(CorePatrolItem::class, 'patrol_item_id');
    }
    // /**
    //  * The attributes that should be hidden for serialization.
    //  *
    //  * @var array
    //  */
    // // protected $hidden = [
    // //     'password',
    // //     'remember_token',
    // // ];

    // /**
    //  * The attributes that should be cast.
    //  *
    //  * @var array
    //  */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
