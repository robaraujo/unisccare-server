<?php

namespace App\Repositories\Staff;

use App\Models\Staff\Forum;
use InfyOm\Generator\Common\BaseRepository;

class ForumRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'admin_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Forum::class;
    }
}
