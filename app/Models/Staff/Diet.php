<?php

namespace App\Models\Staff;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Diet
 * @package App\Models\Staff
 * @version June 9, 2018, 12:35 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection userFollow
 * @property integer staff_id
 * @property string food_ids
 * @property string food_qtts
 * @property string user_ids
 * @property boolean active
 */
class Diet extends Model
{
    use SoftDeletes;

    public $table = 'diets';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'staff_id',
        'food_ids',
        'food_qtts',
        'user_ids',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title'=> 'string',
        'staff_id' => 'integer',
        'food_ids' => 'string',
        'food_qtts' => 'string',
        'user_ids' => 'string',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
