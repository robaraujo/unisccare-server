<?php

namespace App\Repositories\Staff;

use App\Models\Staff\Food;
use InfyOm\Generator\Common\BaseRepository;

class FoodRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Configure the Model
     **/
    public function model()
    {
        return Food::class;
    }
}
