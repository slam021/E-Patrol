<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorePatrolTask extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var string[]
    //  */

    protected $table        = 'core_patrol_task';
    protected $primaryKey   = 'task_id';

    // protected $fillable = [
    //     'user_id',
    //     'full_name',
    //     'address',
    //     'phone_number',
    //     'phone_number_family',
    //     'email',
    // ];
    protected $guarded = [
        'task_id'
    ];
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

