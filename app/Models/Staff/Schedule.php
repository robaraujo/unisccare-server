<?php

namespace App\Models\Staff;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Schedule",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
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
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="sunday",
 *          description="sunday",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="monday",
 *          description="monday",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="tuesday",
 *          description="tuesday",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="wednesday",
 *          description="wednesday",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="thursday",
 *          description="thursday",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="friday",
 *          description="friday",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="saturday",
 *          description="saturday",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="staff_id",
 *          description="staff_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="suggestion_accepted",
 *          description="suggestion_accepted",
 *          type="boolean"
 *      )
 * )
 */
class Schedule extends Model
{
    use SoftDeletes;

    public $table = 'schedules';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'title',
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'datehr',
        'staff_id',
        'suggestion_accepted'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'title' => 'string',
        'sunday' => 'boolean',
        'monday' => 'boolean',
        'tuesday' => 'boolean',
        'wednesday' => 'boolean',
        'thursday' => 'boolean',
        'friday' => 'boolean',
        'saturday' => 'boolean',
        'staff_id' => 'integer',
        'suggestion_accepted' => 'boolean'
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
}
