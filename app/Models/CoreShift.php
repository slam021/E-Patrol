<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class CoreShift extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table        = 'core_shift';
    protected $primaryKey   = 'shift_id';

    protected $guarded = [
        'shift_id'
    ];
}
