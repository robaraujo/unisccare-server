<?php

namespace App\Repositories\Staff;

use App\Models\Staff\UserFollow;
use InfyOm\Generator\Common\BaseRepository;

class UserFollowRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'following_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserFollow::class;
    }
}
