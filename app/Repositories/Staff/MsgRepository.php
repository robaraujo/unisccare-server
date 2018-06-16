<?php

namespace App\Repositories\Staff;

use App\Models\Staff\Msg;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MsgRepository
 * @package App\Repositories\Staff
 * @version June 6, 2018, 5:35 pm -03
 *
 * @method Msg findWithoutFail($id, $columns = ['*'])
 * @method Msg find($id, $columns = ['*'])
 * @method Msg first($columns = ['*'])
*/
class MsgRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'staff_id',
        'from',
        'automatic',
        'content',
        'viewed'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Msg::class;
    }
}
