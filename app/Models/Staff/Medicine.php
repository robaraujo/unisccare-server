<?php

namespace App\Models\Staff;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * @SWG\Definition(
 *      definition="Medicine",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="active_compound",
 *          description="active_compound",
 *          type="string"
 *      )
 * )
 */
class Medicine extends Model
{
    use SoftDeletes;

    public $table = 'medicines';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'active_compound'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'active_compound' => 'string'
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
            $where = "AND date(user_medicine.created_at) = :date";
            $params["date"] = "{$year}-{$month}-{$day}";
        } else if ($view === 'week'){
            $group = 'DAY';
            $where = "AND YEARWEEK(user_medicine.created_at) = YEARWEEK(:date) ";
            $params["date"] = "{$year}-{$month}-{$day}";
        } else if ($view === 'month') {
            $group = 'DAY';
            $where = "AND MONTH(user_medicine.created_at) = :month ";
            $where.= "AND YEAR(user_medicine.created_at) = :year";
            $params["month"] = $month;
            $params['year'] = $year;
        } else if ($view === 'year') {
            $group = 'MONTH';
            $where = "AND YEAR(user_medicine.created_at) = :year";
            $params['year'] = $year;
        }

        $sql = "
        SELECT 
            user_medicine.*, medicines.name, sum(user_medicine.qtt) as total
        FROM 
            user_medicine INNER JOIN medicines ON user_medicine.medicine_id = medicines.id
        WHERE user_medicine.user_id = :user_id
            {$where}
        GROUP BY 
            medicines.id, {$group}(user_medicine.created_at)";

        return DB::select($sql, $params);
    }
}
