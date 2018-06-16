<?php

namespace App\Repositories\Staff;

use App\Models\Staff\Photo;
use InfyOm\Generator\Common\BaseRepository;

class PhotoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'filename'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Photo::class;
    }
}
