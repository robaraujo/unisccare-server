<?php

namespace App\Repositories\Staff;

use App\Models\Staff\UserMedicine;
use InfyOm\Generator\Common\BaseRepository;

class UserMedicineRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'qtt',
        'user_id',
        'medicine_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserMedicine::class;
    }
}
