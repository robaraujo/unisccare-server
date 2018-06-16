<?php

namespace App\Repositories\Staff;

use App\Models\Staff\MedRating;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MedRatingRepository
 * @package App\Repositories\Staff
 * @version May 3, 2018, 2:04 am UTC
 *
 * @method MedRating findWithoutFail($id, $columns = ['*'])
 * @method MedRating find($id, $columns = ['*'])
 * @method MedRating first($columns = ['*'])
*/
class MedRatingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'staff_id',
        'user_id',
        'rating',
        'text'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MedRating::class;
    }
}
