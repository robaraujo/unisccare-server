<?php

namespace App\Models\Staff;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * @SWG\Definition(
 *      definition="Food",
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
 *          property="unity",
 *          description="unity",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="portion",
 *          description="portion",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="protein",
 *          description="protein",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="carb",
 *          description="carb",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="satured_fat",
 *          description="satured_fat",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="trans_fat",
 *          description="trans_fat",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="total_fat",
 *          description="total_fat",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="fiber",
 *          description="fiber",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="sodium",
 *          description="sodium",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="iron",
 *          description="iron",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="calcium",
 *          description="calcium",
 *          type="number",
 *          format="float"
 *      )
 * )
 */
class Food extends Model
{
    use SoftDeletes;

    public $table = 'foods';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'unity',
        'portion',
        'protein',
        'carb',
        'satured_fat',
        'trans_fat',
        'total_fat',
        'fiber',
        'sodium',
        'iron',
        'calcium'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'unity' => 'string',
        'portion' => 'integer',
        'protein' => 'float',
        'carb' => 'float',
        'satured_fat' => 'float',
        'trans_fat' => 'float',
        'total_fat' => 'float',
        'fiber' => 'float',
        'sodium' => 'float',
        'iron' => 'float',
        'calcium' => 'float'
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
            $where = "AND date(user_food.created_at) = :date";
            $params["date"] = "{$year}-{$month}-{$day}";
        } else if ($view === 'week'){
            $group = 'DAY';
            $where = "AND YEARWEEK(user_food.created_at) = YEARWEEK(:date) ";
            $params["date"] = "{$year}-{$month}-{$day}";
        } else if ($view === 'month') {
            $group = 'DAY';
            $where = "AND MONTH(user_food.created_at) = :month ";
            $where.= "AND YEAR(user_food.created_at) = :year";
            $params["month"] = $month;
            $params['year'] = $year;
        } else if ($view === 'year') {
            $group = 'MONTH';
            $where = "AND YEAR(user_food.created_at) = :year";
            $params['year'] = $year;
        }

        $sql = "
        SELECT 
            user_food.*, foods.name, sum(user_food.qtt) as total, portion, unity,
            protein, carb, satured_fat, trans_fat, total_fat, fiber, sodium, iron, calcium
        FROM 
            user_food INNER JOIN foods ON user_food.food_id = foods.id
        WHERE user_food.user_id = :user_id
            {$where}
        GROUP BY 
            foods.id, {$group}(user_food.created_at)";

        return DB::select($sql, $params);
    }
}
