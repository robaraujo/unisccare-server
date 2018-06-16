<?php

namespace App\Repositories\Staff;

use App\Models\Staff\UserFood;
use InfyOm\Generator\Common\BaseRepository;

class UserFoodRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'qtt',
        'user_id',
        'food_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserFood::class;
    }
}
