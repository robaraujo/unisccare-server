<?php

namespace App\Repositories\Staff;

use App\Models\Staff\User;
use InfyOm\Generator\Common\BaseRepository;

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'age',
        'picture',
        'state',
        'city',
        'gender',
        'bio',
        'staff_id',
        'points',
        'first_weight',
        'last_weight',
        'dt_operation',
        'id_facebook',
        'id_twitter',
        'id_google',
        'id_linkedin',
        'remember_token'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
