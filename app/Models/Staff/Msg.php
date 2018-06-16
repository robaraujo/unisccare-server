<?php

namespace App\Models\Staff;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Msg
 * @package App\Models\Staff
 * @version June 6, 2018, 5:35 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection userFollow
 * @property integer user_id
 * @property integer staff_id
 * @property string from
 * @property boolean automatic
 * @property string content
 * @property boolean viewed
 */
class Msg extends Model
{
    use SoftDeletes;

    public $table = 'msg';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'staff_id',
        'from',
        'automatic',
        'content',
        'viewed'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'staff_id' => 'integer',
        'from' => 'string',
        'automatic' => 'boolean',
        'content' => 'string',
        'viewed' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
