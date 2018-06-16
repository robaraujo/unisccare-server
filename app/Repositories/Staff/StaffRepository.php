<?php

namespace App\Repositories\Staff;

use App\Models\Staff\Staff;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StaffRepository
 * @package App\Repositories\Staff
 * @version May 3, 2018, 4:57 am UTC
 *
 * @method Staff findWithoutFail($id, $columns = ['*'])
 * @method Staff find($id, $columns = ['*'])
 * @method Staff first($columns = ['*'])
*/
class StaffRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password',
        'age',
        'gender',
        'bio',
        'clinic',
        'degree',
        'remember_token'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Staff::class;
    }
}
