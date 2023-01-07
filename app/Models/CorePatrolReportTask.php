<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorePatrolReportTask extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table        = 'core_patrol_report_task';
    protected $primaryKey   = 'patrol_report_task_id';

    // protected $fillable = [
    //     'user_id',
    //     'full_name',
    //     'address',
    //     'phone_number',
    //     'phone_number_family',
    //     'email',
    // ];
    protected $guarded = [
        'patrol_report_task_id'
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
