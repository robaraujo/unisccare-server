<?php

namespace App\Models\Staff;

use Eloquent as Model;
use DB;

/**
 * Class Step
 * @package App\Models\Staff
 * @version May 21, 2018, 12:30 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection userFollow
 * @property integer user_id
 * @property integer steps
 * @property date start_date
 * @property date end_date
 */
class Step extends Model
{

    public $table = 'steps';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'user_id',
        'steps',
        'start_date',
        'end_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'steps' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime'
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
            $where = "AND date(steps.created_at) = :date";
            $params["date"] = "{$year}-{$month}-{$day}";
        } else if ($view === 'week'){
            $group = 'DAY';
            $where = "AND YEARWEEK(steps.created_at) = YEARWEEK(:date) ";
            $params["date"] = "{$year}-{$month}-{$day}";
        } else if ($view === 'month') {
            $group = 'DAY';
            $where = "AND MONTH(steps.created_at) = :month ";
            $where.= "AND YEAR(steps.created_at) = :year";
            $params["month"] = $month;
            $params['year'] = $year;
        } else if ($view === 'year') {
            $group = 'MONTH';
            $where = "AND YEAR(steps.created_at) = :year";
            $params['year'] = $year;
        }

        $sql = "
        SELECT 
            *, sum(steps.steps) as total
        FROM 
            steps
        WHERE 
            steps.user_id = :user_id
            {$where}
        GROUP BY 
            {$group}(steps.created_at)";

        return DB::select($sql, $params);
    }
    
}
