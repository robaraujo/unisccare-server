<?php

namespace App\Repositories\Staff;

use App\Models\Staff\Schedule;
use InfyOm\Generator\Common\BaseRepository;

class ScheduleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'title',
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'date',
        'staff_id',
        'suggestion_accepted'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Schedule::class;
    }
}
