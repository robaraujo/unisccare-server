<?php

namespace App\Repositories\Staff;

use App\Models\Staff\Medicine;
use InfyOm\Generator\Common\BaseRepository;

class MedicineRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'active_compound'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Medicine::class;
    }
}
