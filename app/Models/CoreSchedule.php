<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreSchedule extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table        = 'core_schedule';
    protected $primaryKey   = 'schedule_id';

    protected $guarded = [
        'schedule_id'
    ];

    // public function corepatrol()
    // {
    //     return $this->BelongsTo(CorePatrol::class, 'patrol_id');
    // }
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
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
