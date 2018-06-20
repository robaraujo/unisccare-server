<?php

namespace App\Http\Controllers\Api;

use App\Models\Staff\Staff;
use App\Models\Staff\MedRating;
use App\Http\Controllers\AuthenticateController;
use Input;
use Request;
use DB;

class Staff2Controller extends AuthenticateController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the Forum.
     *
     * @param Request $request
     * @return Response
     */
    public function ratings()
    {
        
        $ratings_sql = "
            select
                staffs.*,
                AVG(med_rating.rating) as avarage,
                count(med_rating.rating) as total_ratings,
                sum(case when `text` is null then 0 else 1 end) as total_comments
            from
              staffs
            left join
              med_rating on staffs.id = med_rating.staff_id
            WHERE
              staff_admin IS NULL
            group by 
                staffs.id
            order by avarage desc
        ";

        // count times user rate
        $you_rate = MedRating::where('user_id', $this->user->id)->count();

        $results = DB::select($ratings_sql);
        return response()->json([
            'staffs'   => $results,
            'you_rate'  => $you_rate
        ]);
    }

    public function rate(Request $request)
    {
      $input = array_map('strip_tags', \Input::all());
      $input['user_id'] = $this->user->id;

      if (!$rate = MedRating::create($input)) {
        return response()->json(['error'=>'Server error'], 403);
      }

      return response()->json($rate);      
    }

    
    public function listStaffs() {
        return Staff::where('staff_admin', '')->orWhereNull('staff_admin')->with('team')->get();
    }
}
