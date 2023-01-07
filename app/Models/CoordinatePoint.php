<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoordinatePoint extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table        = 'coordinate_point';
    protected $primaryKey   = 'user_id';

    protected $guarded = [
        'user_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [];
}
