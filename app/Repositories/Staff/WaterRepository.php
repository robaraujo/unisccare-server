<?php

namespace App\Repositories\Staff;

use App\Models\Staff\Water;
use InfyOm\Generator\Common\BaseRepository;

class WaterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'qtt',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Water::class;
    }
}
