<?php

namespace App\Repositories\Staff;

use App\Models\Staff\Weight;
use InfyOm\Generator\Common\BaseRepository;

class WeightRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'weight'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Weight::class;
    }
}
