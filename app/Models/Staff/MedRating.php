<?php

namespace App\Models\Staff;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MedRating
 * @package App\Models\Staff
 * @version May 3, 2018, 2:04 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection userFollow
 * @property integer staff_id
 * @property integer user_id
 * @property integer rating
 * @property string text
 */
class MedRating extends Model
{
    use SoftDeletes;

    public $table = 'med_rating';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'staff_id',
        'user_id',
        'rating',
        'text'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'staff_id' => 'integer',
        'user_id' => 'integer',
        'rating' => 'integer',
        'text' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function staff()
    {
        return $this->belongsTo('App\Models\Staff\Staff');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\Staff\User');
    }
}
