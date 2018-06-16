<?php

namespace App\Repositories\Staff;

use App\Models\Staff\Step;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StepRepository
 * @package App\Repositories\Staff
 * @version May 21, 2018, 12:30 am UTC
 *
 * @method Step findWithoutFail($id, $columns = ['*'])
 * @method Step find($id, $columns = ['*'])
 * @method Step first($columns = ['*'])
*/
class StepRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'steps',
        'start_date',
        'end_date'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Step::class;
    }
}
