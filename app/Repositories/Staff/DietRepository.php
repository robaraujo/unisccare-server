<?php

namespace App\Repositories\Staff;

use App\Models\Staff\Diet;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DietRepository
 * @package App\Repositories\Staff
 * @version June 9, 2018, 12:35 pm -03
 *
 * @method Diet findWithoutFail($id, $columns = ['*'])
 * @method Diet find($id, $columns = ['*'])
 * @method Diet first($columns = ['*'])
*/
class DietRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'staff_id',
        'food_ids',
        'food_qtts',
        'user_ids',
        'active'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Diet::class;
    }
}
