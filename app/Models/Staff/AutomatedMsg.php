<?php

namespace App\Models\Staff;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AutomatedMsg
 * @package App\Models\Staff
 * @version June 6, 2018, 7:59 am -03
 *
 * @property \Illuminate\Database\Eloquent\Collection userFollow
 * @property integer staff_id
 * @property string period_type
 * @property integer period_number
 * @property string msg_user
 * @property string msg_staff
 */
class AutomatedMsg extends Model
{
    use SoftDeletes;

    public $table = 'automated_msgs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'staff_id',
        'period_type',
        'period_number',
        'msg_user',
        'msg_staff'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'staff_id' => 'integer',
        'period_type' => 'string',
        'period_number' => 'integer',
        'msg_user' => 'string',
        'msg_staff' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
