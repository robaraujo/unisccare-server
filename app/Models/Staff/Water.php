<?php

namespace App\Models\Staff;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * @SWG\Definition(
 *      definition="Water",
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
 *      )
 * )
 */
class Water extends Model
{
    use SoftDeletes;

    public $table = 'waters';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'qtt',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'qtt' => 'integer',
        'user_id' => 'integer'
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
            $where = "AND date(waters.created_at) = :date";
            $params["date"] = "{$year}-{$month}-{$day}";
        } else if ($view === 'week'){
            $group = 'DAY';
            $where = "AND YEARWEEK(waters.created_at) = YEARWEEK(:date) ";
            $params["date"] = "{$year}-{$month}-{$day}";
        } else if ($view === 'month') {
            $group = 'DAY';
            $where = "AND MONTH(waters.created_at) = :month ";
            $where.= "AND YEAR(waters.created_at) = :year";
            $params["month"] = $month;
            $params['year'] = $year;
        } else if ($view === 'year') {
            $group = 'MONTH';
            $where = "AND YEAR(waters.created_at) = :year";
            $params['year'] = $year;
        }

        $sql = "
        SELECT 
            *, sum(waters.qtt) as total
        FROM 
            waters
        WHERE 
            waters.user_id = :user_id
            {$where}
        GROUP BY 
            {$group}(waters.created_at)";

        return DB::select($sql, $params);
    }
}
