<?php

namespace App\Models\Staff;

use App\Models\Staff\UserFood;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * @SWG\Definition(
 *      definition="UserFood",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="qtt",
 *          description="qtt",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="food_id",
 *          description="food_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class UserFood extends Model
{
    use SoftDeletes;

    public $table = 'user_food';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'qtt',
        'user_id',
        'food_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'qtt' => 'integer',
        'user_id' => 'integer',
        'food_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function user()
    {
        return $this->belongsTo('App\Models\Staff\User');
    }

    public function food()
    {
        return $this->belongsTo('App\Models\Staff\Food');
    }
}
