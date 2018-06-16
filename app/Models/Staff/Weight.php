<?php

namespace App\Models\Staff;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * @SWG\Definition(
 *      definition="Weight",
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
 *          property="weight",
 *          description="weight",
 *          type="number",
 *          format="float"
 *      )
 * )
 */
class Weight extends Model
{
    use SoftDeletes;

    public $table = 'weights';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'weight'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'weight' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];


    public static function report($user_id, $view, $year, $month, $day) {
        $views = ['day', 'month', 'week', 'year'];
        $params = ['user_id'=> $user_id];
        $group = 'HOUR';

        if (!in_array($view, $views)) {
            throw new \Exception('Invalid view type');
        }

        if ($view === 'day') {
            $where = "AND date(weights.created_at) = :date";
            $params["date"] = "{$year}-{$month}-{$day}";
        } else if ($view === 'week'){
            $group = 'DAY';
            $where = "AND YEARWEEK(weights.created_at) = YEARWEEK(:date) ";
            $params["date"] = "{$year}-{$month}-{$day}";
        } else if ($view === 'month') {
            $group = 'DAY';
            $where = "AND MONTH(weights.created_at) = :month ";
            $where.= "AND YEAR(weights.created_at) = :year";
            $params["month"] = $month;
            $params['year'] = $year;
        } else if ($view === 'year') {
            $group = 'MONTH';
            $where = "AND YEAR(weights.created_at) = :year";
            $params['year'] = $year;
        }

        $sql = "
        SELECT 
            *, weights.weight
        FROM 
            weights
        WHERE 
            weights.user_id = :user_id
            {$where}
        GROUP BY 
            {$group}(weights.created_at)";

        return DB::select($sql, $params);
    }

    
}
