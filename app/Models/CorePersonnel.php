<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorePersonnel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var string[]
    //  */

    protected $table        = 'core_personnel';
    protected $primaryKey   = 'personnel_id';

    // protected $fillable = [
    //     'personnel_id',
    //     'full_name',
    //     'address',
    //     'phone_number',
    //     'phone_number_family',
    //     'email',
    // ];
    protected $guarded = [
        'personnel_id'
    ];
}
