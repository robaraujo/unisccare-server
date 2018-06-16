<?php

namespace App\Repositories\Staff;

use App\Models\Staff\AutomatedMsg;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AutomatedMsgRepository
 * @package App\Repositories\Staff
 * @version June 6, 2018, 7:59 am -03
 *
 * @method AutomatedMsg findWithoutFail($id, $columns = ['*'])
 * @method AutomatedMsg find($id, $columns = ['*'])
 * @method AutomatedMsg first($columns = ['*'])
*/
class AutomatedMsgRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'staff_id',
        'period_type',
        'period_number',
        'msg_user',
        'msg_staff'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AutomatedMsg::class;
    }
}
