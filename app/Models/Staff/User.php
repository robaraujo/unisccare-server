<?php

namespace App\Models\Staff;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="User",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="first_name",
 *          description="first_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="last_name",
 *          description="last_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="age",
 *          description="age",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="picture",
 *          description="picture",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="state",
 *          description="state",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="city",
 *          description="city",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="gender",
 *          description="gender",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="bio",
 *          description="bio",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="staff_id",
 *          description="staff_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="points",
 *          description="points",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="first_weight",
 *          description="first_weight",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="last_weight",
 *          description="last_weight",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="dt_operation",
 *          description="dt_operation",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="dt_end",
 *          description="dt_end",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="id_facebook",
 *          description="id_facebook",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="id_twitter",
 *          description="id_twitter",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="id_google",
 *          description="id_google",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="id_linkedin",
 *          description="id_linkedin",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="remember_token",
 *          description="remember_token",
 *          type="string"
 *      )
 * )
 */
class User extends Model
{
    use SoftDeletes;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'age',
        'picture',
        'state',
        'city',
        'gender',
        'bio',
        'staff_id',
        'points',
        'first_weight',
        'last_weight',
        'dt_operation',
        'dt_end',
        'id_facebook',
        'id_twitter',
        'id_google',
        'id_linkedin',
        'remember_token'
    ];

    
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'age' => 'integer',
        'picture' => 'string',
        'state' => 'string',
        'city' => 'string',
        'gender' => 'string',
        'bio' => 'string',
        'staff_id' => 'integer',
        'points' => 'integer',
        'first_weight' => 'float',
        'last_weight' => 'float',
        'dt_operation' => 'date',
        'dt_end' => 'date',
        'id_facebook' => 'integer',
        'id_twitter' => 'integer',
        'id_google' => 'integer',
        'id_linkedin' => 'integer',
        'remember_token' => 'string'
    ];

    public function msg()
    {
        return $this->hasMany('App\Models\Staff\Msg');
    }
}
