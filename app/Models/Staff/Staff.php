<?php

namespace App\Models\Staff;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Staff
 * @package App\Models\Staff
 * @version May 3, 2018, 4:57 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection userFollow
 * @property string name
 * @property string email
 * @property string password
 * @property integer age
 * @property string gender
 * @property string role
 * @property string clinic
 * @property string degree
 * @property string remember_token
 */
class Staff extends Model
{
    use SoftDeletes;

    public $table = 'staffs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'email',
        'password',
        'age',
        'gender',
        'staff_admin',
        'role',
        'clinic',
        'degree',
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'age' => 'integer',
        'staff_admin' => 'integer',
        'gender' => 'string',
        'role' => 'string',
        'clinic' => 'string',
        'degree' => 'string',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function team()
    {
        return $this->hasMany('App\Models\Staff\Staff', 'staff_admin');
    }
    
}
